<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdmissionController extends Controller
{
    public function index(): View
    {
        $admissions = Admission::query()
            ->latest()
            ->paginate(15);

        $totalApplications = Admission::count();
        $pendingApplications = Admission::where('status', 'pending')->count();
        $acceptedApplications = Admission::where('status', 'accepted')->count();
        $rejectedApplications = Admission::where('status', 'rejected')->count();

        return view('admin.admissions.index', compact(
            'admissions',
            'totalApplications',
            'pendingApplications',
            'acceptedApplications',
            'rejectedApplications'
        ));
    }

    public function show(Admission $admission): View
    {
        return view('admin.admissions.show', compact('admission'));
    }

    public function updateStatus(
        Request $request,
        Admission $admission
    ): RedirectResponse {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,reviewing,accepted,rejected',
            ],
            'admin_notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        DB::transaction(function () use ($admission, $validated) {
            $admission = Admission::whereKey($admission->id)
                ->lockForUpdate()
                ->firstOrFail();

            $newStatus = $validated['status'];

            if ($admission->student_id !== null && $newStatus !== 'accepted') {
                throw ValidationException::withMessages([
                    'status' => 'This application already has an enrolled student. Its accepted status cannot be changed here.',
                ]);
            }

            if ($newStatus === 'accepted' && $admission->student_id === null) {
                $className = $this->normalizeClassName(
                    $admission->class_applying_for
                );

                $studentNumber = $this->makeStudentNumber();

                $student = Student::create([
                    'student_number' => $studentNumber,
                    'first_name' => $admission->first_name,
                    'middle_name' => $admission->middle_name,
                    'last_name' => $admission->last_name,
                    'date_of_birth' => $admission->date_of_birth?->format('Y-m-d'),
                    'gender' => $admission->gender,
                    'class_name' => $className,
                    'guardian_name' => $admission->guardian_name,
                    'guardian_email' => $admission->guardian_email,
                    'guardian_phone' => $admission->guardian_phone,
                    'enrollment_date' => now()->toDateString(),
                    'status' => 'active',
                    'address' => $admission->address,
                ]);

                $admission->student_id = $student->id;
            }

            $admission->status = $newStatus;
            $admission->admin_notes = $validated['admin_notes'] ?? null;
            $admission->save();
        });

        return redirect()
            ->route('admin.admissions.show', $admission)
            ->with(
                'success',
                $validated['status'] === 'accepted'
                    ? 'Application accepted. The student record has been created or was already linked.'
                    : 'Admission application updated successfully.'
            );
    }

    private function makeStudentNumber(): string
    {
        do {
            $number = 'BHA-' . now()->format('Y') . '-'
                . strtoupper(substr(bin2hex(random_bytes(5)), 0, 8));
        } while (Student::where('student_number', $number)->exists());

        return $number;
    }

    private function normalizeClassName(string $className): string
    {
        return match (strtoupper(trim($className))) {
            'SS 1', 'SSS 1' => 'SSS 1',
            'SS 2', 'SSS 2' => 'SSS 2',
            'SS 3', 'SSS 3' => 'SSS 3',
            default => trim($className),
        };
    }
}
