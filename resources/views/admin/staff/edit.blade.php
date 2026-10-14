@extends('layouts.admin')

@section('page-title', 'Edit Staff Member')

@section('content')
<div class="staff-edit-page">
    <div class="staff-edit-heading">
        <div>
            <span class="staff-eyebrow">BLUEHAVEN ACADEMY</span>
            <h1>Edit Staff Member</h1>
            <p>Update the personal and employment details for {{ $staff->full_name }}.</p>
        </div>

        <a href="{{ route('admin.staff.index') }}" class="staff-back">← Back to Staff</a>
    </div>

    @if ($errors->any())
        <div class="staff-errors">
            <strong>Please correct the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.staff.update', $staff) }}" method="POST">
        @csrf
        @method('PUT')

        <section class="staff-card">
            <h2>Personal Information</h2>
            <p class="staff-card-description">Update the employee's contact details.</p>

            <div class="staff-form-grid">
                <div class="staff-field">
                    <label for="first_name">First Name *</label>
                    <input id="first_name" name="first_name" type="text"
                           value="{{ old('first_name', $staff->first_name) }}" required>
                </div>

                <div class="staff-field">
                    <label for="last_name">Last Name *</label>
                    <input id="last_name" name="last_name" type="text"
                           value="{{ old('last_name', $staff->last_name) }}" required>
                </div>

                <div class="staff-field">
                    <label for="email">Email Address *</label>
                    <input id="email" name="email" type="email"
                           value="{{ old('email', $staff->email) }}" required>
                </div>

                <div class="staff-field">
                    <label for="phone">Phone Number</label>
                    <input id="phone" name="phone" type="tel"
                           value="{{ old('phone', $staff->phone) }}">
                </div>

                <div class="staff-field full-width">
                    <label for="address">Home Address</label>
                    <textarea id="address" name="address" rows="3">{{ old('address', $staff->address) }}</textarea>
                </div>
            </div>
        </section>

        <section class="staff-card">
            <h2>Employment Details</h2>
            <p class="staff-card-description">Manage the employee's staff number, department and position.</p>

            <div class="staff-form-grid">
                <div class="staff-field">
                    <label for="staff_number">Staff Number</label>
                    <input id="staff_number" type="text"
                           value="{{ $staff->staff_number }}" readonly>
                    <small>The staff number is automatically generated and cannot be edited.</small>
                </div>

                <div class="staff-field">
                    <label for="department">Department *</label>
                    <select id="department" name="department" required>
                        @php
                            $departments = [
                                'Administration',
                                'Academic Affairs',
                                'Teaching',
                                'Finance',
                                'Admissions',
                                'Information Technology',
                                'Library',
                                'Security',
                                'Cleaning',
                                'Maintenance',
                                'Transport',
                                'Catering',
                                'Other',
                            ];
                            $currentDepartment = old('department', $staff->department);
                        @endphp

                        <option value="">Select department</option>

                        @foreach ($departments as $department)
                            <option value="{{ $department }}"
                                @selected($currentDepartment === $department)>
                                {{ $department }}
                            </option>
                        @endforeach

                        @if (!in_array($currentDepartment, $departments, true))
                            <option value="{{ $currentDepartment }}" selected>
                                {{ $currentDepartment }}
                            </option>
                        @endif
                    </select>
                </div>

                <div class="staff-field">
                    <label for="position">Job Position *</label>
                    <input id="position" name="position" type="text"
                           value="{{ old('position', $staff->position) }}" required>
                </div>

                <div class="staff-field">
                    <label for="hire_date">Hire Date</label>
                    <input id="hire_date" name="hire_date" type="date"
                           value="{{ old('hire_date', $staff->hire_date?->format('Y-m-d')) }}">
                </div>

                <div class="staff-field">
                    <label for="employment_type">Employment Type *</label>
                    <select id="employment_type" name="employment_type" required>
                        <option value="full_time"
                            @selected(old('employment_type', $staff->employment_type) === 'full_time')>
                            Full-time
                        </option>
                        <option value="part_time"
                            @selected(old('employment_type', $staff->employment_type) === 'part_time')>
                            Part-time
                        </option>
                        <option value="contract"
                            @selected(old('employment_type', $staff->employment_type) === 'contract')>
                            Contract
                        </option>
                    </select>
                </div>

                <div class="staff-field">
                    <label for="status">Employment Status *</label>
                    <select id="status" name="status" required>
                        <option value="active"
                            @selected(old('status', $staff->status) === 'active')>
                            Active
                        </option>
                        <option value="inactive"
                            @selected(old('status', $staff->status) === 'inactive')>
                            Inactive
                        </option>
                    </select>
                </div>
            </div>
        </section>

        <section class="staff-card">
            <h2>Salary & Additional Notes</h2>
            <p class="staff-card-description">Update optional compensation information and internal notes.</p>

            <div class="staff-form-grid">
                <div class="staff-field">
                    <label for="salary">Salary (₦)</label>
                    <input id="salary" name="salary" type="number"
                           min="0" max="9999999999.99" step="0.01"
                           value="{{ old('salary', $staff->salary) }}">
                </div>

                <div class="staff-field full-width">
                    <label for="notes">Internal Notes</label>
                    <textarea id="notes" name="notes" rows="4">{{ old('notes', $staff->notes) }}</textarea>
                </div>
            </div>
        </section>

        <div class="staff-form-actions">
            <a href="{{ route('admin.staff.index') }}" class="staff-cancel">Cancel</a>
            <button type="submit" class="staff-submit">Save Changes →</button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
.staff-edit-page {
    max-width: 1050px;
    margin: 0 auto;
    color: #172b4d;
}
.staff-edit-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 25px;
}
.staff-eyebrow {
    color: #315fbd;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
}
.staff-edit-heading h1 {
    margin: 8px 0;
    color: #17356f;
    font-size: clamp(27px, 4vw, 36px);
}
.staff-edit-heading p,
.staff-card-description {
    color: #6b7890;
    font-size: 12px;
    line-height: 1.7;
}
.staff-back,
.staff-cancel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 42px;
    padding: 0 15px;
    border: 1px solid #dce4f0;
    border-radius: 6px;
    color: #214da5;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
}
.staff-errors {
    margin-bottom: 20px;
    padding: 15px 20px;
    border: 1px solid #efcaca;
    border-radius: 6px;
    background: #fff2f2;
    color: #9f3030;
    font-size: 12px;
}
.staff-errors ul {
    margin-bottom: 0;
}
.staff-card {
    margin-bottom: 20px;
    padding: 24px;
    border: 1px solid #e1e8f3;
    border-radius: 9px;
    background: #fff;
    box-shadow: 0 3px 12px rgba(27, 55, 100, .035);
}
.staff-card h2 {
    margin: 0;
    color: #17356f;
    font-size: 20px;
}
.staff-card-description {
    margin: 6px 0 22px;
}
.staff-form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
}
.staff-field {
    min-width: 0;
}
.staff-field label {
    display: block;
    margin-bottom: 8px;
    color: #314563;
    font-size: 12px;
    font-weight: 700;
}
.staff-field input,
.staff-field select,
.staff-field textarea {
    box-sizing: border-box;
    display: block;
    width: 100%;
    min-height: 43px;
    padding: 11px 12px;
    border: 1px solid #dce4f0;
    border-radius: 5px;
    background: #fff;
    color: #203657;
    font: inherit;
    font-size: 12px;
}
.staff-field textarea {
    resize: vertical;
    line-height: 1.6;
}
.staff-field input:focus,
.staff-field select:focus,
.staff-field textarea:focus {
    outline: 2px solid #c8d8fa;
    border-color: #315fbd;
}
.staff-field input[readonly] {
    background: #f1f5fb;
    color: #63738c;
}
.staff-field small {
    display: block;
    margin-top: 6px;
    color: #71809a;
    font-size: 10px;
    line-height: 1.5;
}
.full-width {
    grid-column: 1 / -1;
}
.staff-form-actions {
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 12px;
    margin: 25px 0;
}
.staff-submit {
    min-height: 44px;
    padding: 0 20px;
    border: 0;
    border-radius: 6px;
    background: #214da5;
    color: #fff;
    font-size: 12px;
    font-weight: 750;
    cursor: pointer;
}
.staff-submit:hover {
    background: #173777;
}
@media (max-width: 650px) {
    .staff-edit-heading {
        align-items: flex-start;
        flex-direction: column;
    }
    .staff-card {
        padding: 18px;
    }
    .staff-form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .full-width {
        grid-column: auto;
    }
    .staff-form-actions > * {
        flex: 1;
    }
}
</style>
@endpush
