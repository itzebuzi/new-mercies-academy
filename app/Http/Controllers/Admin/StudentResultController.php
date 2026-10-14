<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentResult;
use App\Models\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StudentResultController extends Controller
{
    public function index(Request $request): View
    {
        $query = StudentResult::with(['student', 'subject']);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($builder) use ($search) {
                $builder->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('student_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                })->orWhereHas('subject', function ($subjectQuery) use ($search) {
                    $subjectQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('academic_session')) {
            $query->where(
                'academic_session',
                $request->input('academic_session')
            );
        }

        if ($request->filled('term')) {
            $query->where('term', $request->input('term'));
        }

        $results = $query->latest()->paginate(15)->withQueryString();

        return view('admin.results.index', compact('results'));
    }

    public function create(): View
    {
        return view('admin.results.create', [
            'students' => Student::where('status', 'active')
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get(),

            'subjects' => Subject::where('is_active', true)
                ->orderBy('name')
                ->get(),

            'terms' => [
                'First Term',
                'Second Term',
                'Third Term',
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateResult($request);

        $scores = $this->calculateGrade(
            (float) $validated['ca_score'],
            (float) $validated['exam_score']
        );

        StudentResult::create(array_merge($validated, $scores));

        return redirect()
            ->route('admin.results.index')
            ->with('success', 'Student result saved successfully.');
    }

    public function show(StudentResult $result): View
    {
        $result->load(['student', 'subject']);

        return view('admin.results.show', compact('result'));
    }

    public function edit(StudentResult $result): View
    {
        $result->load(['student', 'subject']);

        return view('admin.results.edit', [
            'result' => $result,
            'students' => Student::orderBy('first_name')
                ->orderBy('last_name')
                ->get(),
            'subjects' => Subject::orderBy('name')->get(),
            'terms' => [
                'First Term',
                'Second Term',
                'Third Term',
            ],
        ]);
    }

    public function update(
        Request $request,
        StudentResult $result
    ): RedirectResponse {
        $validated = $this->validateResult($request, $result);

        $scores = $this->calculateGrade(
            (float) $validated['ca_score'],
            (float) $validated['exam_score']
        );

        $result->update(array_merge($validated, $scores));

        return redirect()
            ->route('admin.results.index')
            ->with('success', 'Student result updated successfully.');
    }

    private function validateResult(
        Request $request,
        ?StudentResult $result = null
    ): array {
        $uniqueResult = Rule::unique('student_results', 'student_id')
            ->where(function ($query) use ($request) {
                return $query
                    ->where('subject_id', $request->input('subject_id'))
                    ->where(
                        'academic_session',
                        $request->input('academic_session')
                    )
                    ->where('term', $request->input('term'));
            });

        if ($result !== null) {
            $uniqueResult->ignore($result->id);
        }

        return $request->validate([
            'student_id' => [
                'required',
                'integer',
                'exists:students,id',
                $uniqueResult,
            ],

            'subject_id' => [
                'required',
                'integer',
                'exists:subjects,id',
            ],

            'academic_session' => [
                'required',
                'string',
                'max:20',
            ],

            'term' => [
                'required',
                Rule::in([
                    'First Term',
                    'Second Term',
                    'Third Term',
                ]),
            ],

            'ca_score' => [
                'required',
                'numeric',
                'min:0',
                'max:40',
            ],

            'exam_score' => [
                'required',
                'numeric',
                'min:0',
                'max:60',
            ],

            'teacher_comment' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'student_id.unique' =>
                'A result already exists for this student, subject, academic session, and term.',

            'ca_score.max' =>
                'Continuous assessment cannot exceed 40.',

            'exam_score.max' =>
                'Examination score cannot exceed 60.',
        ]);
    }

    private function calculateGrade(float $ca, float $exam): array
    {
        $total = round($ca + $exam, 2);

        $grade = match (true) {
            $total >= 80 => 'A',
            $total >= 70 => 'B',
            $total >= 60 => 'C',
            $total >= 50 => 'D',
            $total >= 40 => 'E',
            default => 'F',
        };

        $remark = match ($grade) {
            'A' => 'Excellent',
            'B' => 'Very Good',
            'C' => 'Good',
            'D' => 'Credit',
            'E' => 'Pass',
            default => 'Fail',
        };

        return [
            'total_score' => $total,
            'grade' => $grade,
            'remark' => $remark,
        ];
    }
}
