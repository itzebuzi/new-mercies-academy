<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = SchoolClass::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('section', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('level'), function ($query) use ($request) {
                $query->where('level', $request->level);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'is_active',
                    $request->status === 'active'
                );
            })
            ->orderBy('level')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $totalClasses = SchoolClass::count();
        $activeClasses = SchoolClass::where('is_active', true)->count();
        $inactiveClasses = SchoolClass::where('is_active', false)->count();

        return view('admin.classes.index', compact(
            'classes',
            'totalClasses',
            'activeClasses',
            'inactiveClasses'
        ));
    }

    public function create()
    {
        return view('admin.classes.create', [
            'schoolClass' => new SchoolClass(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateClass($request);

        $validated['section'] = $validated['section'] ?? null;
        $validated['is_active'] = $request->boolean('is_active');

        SchoolClass::create($validated);

        return redirect()
            ->route('admin.classes.index')
            ->with('success', 'Class created successfully.');
    }

    public function show(SchoolClass $schoolClass)
    {
        return view('admin.classes.show', compact('schoolClass'));
    }

    public function edit(SchoolClass $schoolClass)
    {
        return view('admin.classes.edit', compact('schoolClass'));
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $validated = $this->validateClass($request, $schoolClass);

        $validated['section'] = $validated['section'] ?? null;
        $validated['is_active'] = $request->boolean('is_active');

        $schoolClass->update($validated);

        return redirect()
            ->route('admin.classes.show', $schoolClass)
            ->with('success', 'Class updated successfully.');
    }

    public function toggleStatus(SchoolClass $schoolClass)
    {
        $schoolClass->update([
            'is_active' => ! $schoolClass->is_active,
        ]);

        return back()->with('success', 'Class status updated successfully.');
    }

    private function validateClass(
        Request $request,
        ?SchoolClass $schoolClass = null
    ): array {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'level' => [
                'required',
                Rule::in([
                    'primary',
                    'junior_secondary',
                    'senior_secondary',
                ]),
            ],
            'section' => ['nullable', 'string', 'max:30'],
            'capacity' => ['required', 'integer', 'min:1', 'max:500'],
            'description' => ['nullable', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $duplicate = SchoolClass::query()
            ->where('name', $validated['name'])
            ->where('section', $validated['section'] ?? null)
            ->when($schoolClass, function ($query) use ($schoolClass) {
                $query->where('id', '!=', $schoolClass->id);
            })
            ->exists();

        if ($duplicate) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'name' => 'A class with this name and section already exists.',
            ]);
        }

        return $validated;
    }
}
