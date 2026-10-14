<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'is_active',
                    $request->status === 'active'
                );
            })
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $totalSubjects = Subject::count();
        $activeSubjects = Subject::where('is_active', true)->count();
        $inactiveSubjects = Subject::where('is_active', false)->count();

        return view('admin.subjects.index', compact(
            'subjects',
            'totalSubjects',
            'activeSubjects',
            'inactiveSubjects'
        ));
    }

    public function create()
    {
        return view('admin.subjects.create', [
            'subject' => new Subject(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateSubject($request);

        $validated['code'] = strtoupper($validated['code']);
        $validated['is_active'] = $request->boolean('is_active');

        Subject::create($validated);

        return redirect()
            ->route('admin.subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $this->validateSubject($request, $subject);

        $validated['code'] = strtoupper($validated['code']);
        $validated['is_active'] = $request->boolean('is_active');

        $subject->update($validated);

        return redirect()
            ->route('admin.subjects.show', $subject)
            ->with('success', 'Subject updated successfully.');
    }

    public function toggleStatus(Subject $subject)
    {
        $subject->update([
            'is_active' => ! $subject->is_active,
        ]);

        return back()->with('success', 'Subject status updated successfully.');
    }

    private function validateSubject(
        Request $request,
        ?Subject $subject = null
    ): array {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('subjects', 'code')->ignore($subject?->id),
            ],
            'description' => ['nullable', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
