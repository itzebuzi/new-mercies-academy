<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(['active', 'inactive'])],
        ]);

        $staffQuery = Staff::query()
            ->when($validated['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('staff_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('position', 'like', "%{$search}%");
                });
            })
            ->when($validated['department'] ?? null, function ($query, $department) {
                $query->where('department', $department);
            })
            ->when($validated['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            });

        $staff = $staffQuery
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate(12)
            ->withQueryString();

        $stats = [
            'total' => Staff::count(),
            'active' => Staff::where('status', 'active')->count(),
            'inactive' => Staff::where('status', 'inactive')->count(),
            'departments' => Staff::query()
                ->whereNotNull('department')
                ->where('department', '!=', '')
                ->distinct()
                ->count('department'),
        ];

        $departments = Staff::query()
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        return view('admin.staff.index', compact(
            'staff',
            'stats',
            'departments'
        ));
    }

    public function create(): View
    {
        return view('admin.staff.create', [
            'staff' => new Staff(),
            'formTitle' => 'Register Staff Member',
            'formAction' => route('admin.staff.store'),
            'formMethod' => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateStaff($request);

        $validated['staff_number'] = $this->generateStaffNumber();
        $validated['email'] = Str::lower(trim($validated['email']));

        $staff = Staff::create($validated);

        return redirect()
            ->route('admin.staff.show', $staff)
            ->with('success', 'Staff member registered successfully.');
    }

    public function show(Staff $staff): View
    {
        return view('admin.staff.show', compact('staff'));
    }

    public function edit(Staff $staff): View
    {
        return view('admin.staff.edit', [
            'staff' => $staff,
            'formTitle' => 'Edit Staff Member',
            'formAction' => route('admin.staff.update', $staff),
            'formMethod' => 'PUT',
        ]);
    }

    public function update(Request $request, Staff $staff): RedirectResponse
    {
        $validated = $this->validateStaff($request, $staff);
        $validated['email'] = Str::lower(trim($validated['email']));

        $staff->update($validated);

        return redirect()
            ->route('admin.staff.show', $staff)
            ->with('success', 'Staff record updated successfully.');
    }

    public function toggleStatus(Staff $staff): RedirectResponse
    {
        $staff->update([
            'status' => $staff->status === 'active' ? 'inactive' : 'active',
        ]);

        return redirect()
            ->route('admin.staff.show', $staff)
            ->with('success', 'Staff status updated successfully.');
    }

    private function validateStaff(
        Request $request,
        ?Staff $staff = null
    ): array {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('staff', 'email')->ignore($staff?->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'department' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:150'],
            'hire_date' => ['nullable', 'date'],
            'salary' => ['nullable', 'numeric', 'min:0', 'max:9999999999.99'],
            'employment_type' => [
                'required',
                Rule::in(['full_time', 'part_time', 'contract']),
            ],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'address' => ['nullable', 'string', 'max:2000'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);
    }

    private function generateStaffNumber(): string
    {
        do {
            $number = 'BHS-' . now()->format('Y') . '-'
                . strtoupper(bin2hex(random_bytes(4)));
        } while (Staff::where('staff_number', $number)->exists());

        return $number;
    }
}
