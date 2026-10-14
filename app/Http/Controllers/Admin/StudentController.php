<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $className = trim((string) $request->query('class_name', ''));

        $students = Student::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('student_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('guardian_name', 'like', "%{$search}%");
                });
            })
            ->when($className !== '', fn ($query) => $query->where('class_name', $className))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $classes = Student::query()
            ->select('class_name')
            ->distinct()
            ->orderBy('class_name')
            ->pluck('class_name');

        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'active')->count();
        $inactiveStudents = Student::where('status', 'inactive')->count();

        return view('admin.students.index', compact(
            'students',
            'search',
            'className',
            'classes',
            'totalStudents',
            'activeStudents',
            'inactiveStudents'
        ));
    }

    public function create(): View
    {
        return view('admin.students.create', [
            'student' => new Student(),
            'formAction' => route('admin.students.store'),
            'formMethod' => 'POST',
            'pageHeading' => 'Register Student',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateStudent($request);
        $validated['student_number'] = $this->makeStudentNumber();

        $student = Student::create($validated);

        return redirect()
            ->route('admin.students.show', $student)
            ->with('success', 'Student registered successfully.');
    }

    public function show(Student $student): View
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('admin.students.create', [
            'student' => $student,
            'formAction' => route('admin.students.update', $student),
            'formMethod' => 'PUT',
            'pageHeading' => 'Edit Student Record',
        ]);
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $this->validateStudent($request, $student);
        $student->update($validated);

        return redirect()
            ->route('admin.students.show', $student)
            ->with('success', 'Student record updated successfully.');
    }

    private function validateStudent(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'class_name' => ['required', 'string', 'max:50'],
            'guardian_name' => ['required', 'string', 'max:150'],
            'guardian_email' => ['nullable', 'email', 'max:255'],
            'guardian_phone' => ['required', 'string', 'max:30'],
            'enrollment_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'address' => ['nullable', 'string', 'max:2000'],
        ]);
    }

    private function makeStudentNumber(): string
    {
        do {
            $number = 'BHA-' . now()->format('Y') . '-' . strtoupper(substr(bin2hex(random_bytes(5)), 0, 8));
        } while (Student::where('student_number', $number)->exists());

        return $number;
    }
}
