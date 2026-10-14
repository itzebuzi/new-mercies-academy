<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
        ]);

        $teachers = Teacher::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('teacher_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('middle_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('specialization', 'like', "%{$search}%");
                });
            })
            ->when($validated['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => Teacher::count(),
            'active' => Teacher::where('status', 'active')->count(),
            'inactive' => Teacher::where('status', 'inactive')->count(),
        ];

        return view('admin.teachers.index', compact('teachers', 'stats'));
    }

    public function create(): View
    {
        $teacher = new Teacher();

        return view('admin.teachers.form', [
            'teacher' => $teacher,
            'formTitle' => 'Register Teacher',
            'formAction' => route('admin.teachers.store'),
            'formMethod' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTeacher($request);

        $validated['teacher_number'] = $this->generateTeacherNumber();

        $teacher = Teacher::create($validated);

        return redirect()
            ->route('admin.teachers.show', $teacher)
            ->with('success', 'Teacher registered successfully.');
    }

    public function show(Teacher $teacher): View
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher): View
    {
        return view('admin.teachers.form', [
            'teacher' => $teacher,
            'formTitle' => 'Edit Teacher',
            'formAction' => route('admin.teachers.update', $teacher),
            'formMethod' => 'PUT',
        ]);
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $validated = $this->validateTeacher($request, $teacher);
        $teacher->update($validated);

        return redirect()
            ->route('admin.teachers.show', $teacher)
            ->with('success', 'Teacher record updated successfully.');
    }

    public function toggleStatus(Teacher $teacher): RedirectResponse
    {
        $teacher->update([
            'status' => $teacher->status === 'active' ? 'inactive' : 'active',
        ]);

        return redirect()
            ->route('admin.teachers.show', $teacher)
            ->with('success', 'Teacher status updated successfully.');
    }

    private function validateTeacher(
        Request $request,
        ?Teacher $teacher = null
    ): array {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('teachers', 'email')->ignore($teacher?->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
            'qualification' => ['nullable', 'string', 'max:255'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'assigned_class' => ['nullable', 'string', 'max:100'],
            'employment_type' => [
                'required',
                Rule::in(['full_time', 'part_time', 'contract']),
            ],
            'hire_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'address' => ['nullable', 'string', 'max:2000'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);
    }

    private function generateTeacherNumber(): string
    {
        do {
            $number = 'BHT-' . now()->format('Y') . '-'
                . strtoupper(bin2hex(random_bytes(4)));
        } while (Teacher::where('teacher_number', $number)->exists());

        return $number;
    }
}
