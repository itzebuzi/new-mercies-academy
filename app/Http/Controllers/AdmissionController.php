<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdmissionController extends Controller
{
    public function create(): View
    {
        return view('admissions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other'],
            'class_applying_for' => [
                'required',
                'in:Primary 1,Primary 2,Primary 3,Primary 4,Primary 5,Primary 6,JSS 1,JSS 2,JSS 3,SS 1,SS 2,SS 3',
            ],
            'previous_school' => ['nullable', 'string', 'max:200'],
            'guardian_name' => ['required', 'string', 'max:150'],
            'guardian_relationship' => ['nullable', 'string', 'max:100'],
            'guardian_email' => ['required', 'email', 'max:255'],
            'guardian_phone' => ['required', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:2000'],
        ]);

        do {
            $reference = 'BHA-' . Str::upper(Str::random(10));
        } while (
            Admission::where('application_reference', $reference)->exists()
        );

        $validated['application_reference'] = $reference;

        Admission::create($validated);

        return redirect()
            ->route('admissions.confirmation', ['reference' => $reference]);
    }

    public function confirmation(string $reference): View
    {
        $admission = Admission::where(
            'application_reference',
            $reference
        )->firstOrFail();

        return view('admissions.confirmation', compact('admission'));
    }
}