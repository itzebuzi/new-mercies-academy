@extends('layouts.admin')

@section('page-title', $formTitle ?? 'Register Staff Member')

@section('content')
<style>
.staff-form{max-width:1000px;color:#34435a}
.staff-form h2{font-size:29px;color:#123b78;margin:0 0 8px;font-weight:500}
.staff-form .muted{color:#718096;font-size:13px}
.staff-form .panel{background:white;border:1px solid #e0e7f1;border-radius:11px;margin-top:23px;overflow:hidden}
.staff-form .panel-title{padding:19px 22px;border-bottom:1px solid #e7edf5;font-weight:700;color:#123b78}
.staff-form .panel-body{padding:24px}
.staff-form .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.staff-form .field label{display:block;margin-bottom:8px;font-size:13px;font-weight:700}
.staff-form .field input,.staff-form .field select,.staff-form .field textarea{width:100%;padding:12px;border:1px solid #d5dfef;border-radius:7px;background:white;font-size:13px}
.staff-form .field-full{grid-column:1/-1}
.staff-form .error{color:#b42318;font-size:12px;margin-top:5px}
.staff-form .actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:24px}
.staff-form .btn{display:inline-block;padding:12px 18px;border:0;border-radius:7px;background:#163f80;color:white;font-size:13px;font-weight:700;cursor:pointer}
.staff-form .btn-light{background:#edf2fa;color:#123b78}
.staff-form .errors{padding:14px;background:#fff0f0;color:#a12a2a;border-radius:7px;margin-top:18px}
@media(max-width:650px){.staff-form .grid{grid-template-columns:1fr}.staff-form .field-full{grid-column:auto}.staff-form .panel-body{padding:16px}}
</style>

<div class="staff-form">
    <h2>{{ $formTitle ?? 'Register Staff Member' }}</h2>
    <p class="muted">Enter the staff member's employment and contact details.</p>

    @if ($errors->any())
        <div class="errors">
            <strong>Please correct these errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ $formAction ?? route('admin.staff.store') }}">
        @csrf
        @if (($formMethod ?? 'POST') !== 'POST')
            @method($formMethod)
        @endif

        <section class="panel">
            <div class="panel-title">Personal Information</div>
            <div class="panel-body">
                <div class="grid">
                    <div class="field">
                        <label for="first_name">First name *</label>
                        <input id="first_name" name="first_name" maxlength="100" required value="{{ old('first_name', $staff->first_name) }}">
                        @error('first_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="last_name">Last name *</label>
                        <input id="last_name" name="last_name" maxlength="100" required value="{{ old('last_name', $staff->last_name) }}">
                        @error('last_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="email">Email *</label>
                        <input id="email" name="email" type="email" maxlength="255" required value="{{ old('email', $staff->email) }}">
                        @error('email')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" maxlength="30" value="{{ old('phone', $staff->phone) }}">
                        @error('phone')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-title">Employment Information</div>
            <div class="panel-body">
                <div class="grid">
                    <div class="field">
                        <label for="department">Department *</label>
                        <select id="department" name="department" required>
                            @foreach (['Administration','Finance','Admissions','IT Support','Library','Security','Cleaning','Maintenance','Transport','Catering','Other'] as $departmentOption)
                                <option value="{{ $departmentOption }}" @selected(old('department', $staff->department) === $departmentOption)>{{ $departmentOption }}</option>
                            @endforeach
                        </select>
                        @error('department')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="position">Job title / position *</label>
                        <input id="position" name="position" maxlength="150" required value="{{ old('position', $staff->position) }}">
                        @error('position')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="employment_type">Employment type *</label>
                        <select id="employment_type" name="employment_type" required>
                            <option value="full_time" @selected(old('employment_type', $staff->employment_type ?? 'full_time') === 'full_time')>Full time</option>
                            <option value="part_time" @selected(old('employment_type', $staff->employment_type) === 'part_time')>Part time</option>
                            <option value="contract" @selected(old('employment_type', $staff->employment_type) === 'contract')>Contract</option>
                        </select>
                        @error('employment_type')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="hire_date">Hire date</label>
                        <input id="hire_date" name="hire_date" type="date" value="{{ old('hire_date', $staff->hire_date?->format('Y-m-d')) }}">
                        @error('hire_date')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="salary">Salary</label>
                        <input id="salary" name="salary" type="number" min="0" step="0.01" value="{{ old('salary', $staff->salary) }}">
                        @error('salary')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="active" @selected(old('status', $staff->status ?? 'active') === 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $staff->status) === 'inactive')>Inactive</option>
                        </select>
                        @error('status')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field field-full">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3" maxlength="2000">{{ old('address', $staff->address) }}</textarea>
                        @error('address')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field field-full">
                        <label for="notes">Administrative notes</label>
                        <textarea id="notes" name="notes" rows="3" maxlength="5000">{{ old('notes', $staff->notes) }}</textarea>
                        @error('notes')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="actions">
                    <button class="btn" type="submit">{{ $staff->exists ? 'Save Changes' : 'Register Staff Member' }}</button>
                    <a class="btn btn-light" href="{{ route('admin.staff.index') }}">Cancel</a>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection
