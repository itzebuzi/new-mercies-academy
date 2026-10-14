@extends('layouts.admin')

@section('page-title', $formTitle)

@section('content')
<style>
.teacher-form{max-width:1000px;color:#34435a}
.teacher-form h2{font-size:29px;color:#123b78;margin:0 0 8px;font-weight:500}
.teacher-form .muted{color:#718096;font-size:13px}
.teacher-form .panel{background:white;border:1px solid #e0e7f1;border-radius:11px;margin-top:23px;overflow:hidden}
.teacher-form .panel-title{padding:19px 22px;border-bottom:1px solid #e7edf5;font-weight:700;color:#123b78}
.teacher-form .panel-body{padding:24px}
.teacher-form .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.teacher-form .field label{display:block;margin-bottom:8px;font-size:13px;font-weight:700}
.teacher-form .field input,.teacher-form .field select,.teacher-form .field textarea{width:100%;padding:12px;border:1px solid #d5dfef;border-radius:7px;background:white;font-size:13px}
.teacher-form .field-full{grid-column:1/-1}
.teacher-form .error{color:#b42318;font-size:12px;margin-top:5px}
.teacher-form .actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:24px}
.teacher-form .btn{display:inline-block;padding:12px 18px;border:0;border-radius:7px;background:#163f80;color:white;font-size:13px;font-weight:700;cursor:pointer}
.teacher-form .btn-light{background:#edf2fa;color:#123b78}
.teacher-form .errors{padding:14px;background:#fff0f0;color:#a12a2a;border-radius:7px;margin-top:18px}
@media(max-width:650px){.teacher-form .grid{grid-template-columns:1fr}.teacher-form .field-full{grid-column:auto}.teacher-form .panel-body{padding:16px}}
</style>

<div class="teacher-form">
    <h2>{{ $formTitle }}</h2>
    <p class="muted">Enter the teacher's professional and contact details.</p>

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

    <form method="POST" action="{{ $formAction }}">
        @csrf
        @if ($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <section class="panel">
            <div class="panel-title">Personal Information</div>
            <div class="panel-body">
                <div class="grid">
                    <div class="field">
                        <label for="first_name">First name *</label>
                        <input id="first_name" name="first_name" maxlength="100" required value="{{ old('first_name', $teacher->first_name) }}">
                        @error('first_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="middle_name">Middle name</label>
                        <input id="middle_name" name="middle_name" maxlength="100" value="{{ old('middle_name', $teacher->middle_name) }}">
                        @error('middle_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="last_name">Last name *</label>
                        <input id="last_name" name="last_name" maxlength="100" required value="{{ old('last_name', $teacher->last_name) }}">
                        @error('last_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="male" @selected(old('gender', $teacher->gender) === 'male')>Male</option>
                            <option value="female" @selected(old('gender', $teacher->gender) === 'female')>Female</option>
                            <option value="other" @selected(old('gender', $teacher->gender) === 'other')>Other</option>
                        </select>
                        @error('gender')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" maxlength="255" value="{{ old('email', $teacher->email) }}">
                        @error('email')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="tel" maxlength="30" value="{{ old('phone', $teacher->phone) }}">
                        @error('phone')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="qualification">Highest qualification</label>
                        <input id="qualification" name="qualification" maxlength="255" value="{{ old('qualification', $teacher->qualification) }}">
                        @error('qualification')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="specialization">Subject / specialization</label>
                        <input id="specialization" name="specialization" maxlength="255" value="{{ old('specialization', $teacher->specialization) }}">
                        @error('specialization')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="assigned_class">Assigned class</label>
                        <select id="assigned_class" name="assigned_class">
                            <option value="">Not assigned</option>
                            @foreach (['Nursery 1','Nursery 2','Primary 1','Primary 2','Primary 3','Primary 4','Primary 5','Primary 6','JSS 1','JSS 2','JSS 3','SSS 1','SSS 2','SSS 3'] as $classOption)
                                <option value="{{ $classOption }}" @selected(old('assigned_class', $teacher->assigned_class) === $classOption)>{{ $classOption }}</option>
                            @endforeach
                        </select>
                        @error('assigned_class')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="employment_type">Employment type *</label>
                        <select id="employment_type" name="employment_type" required>
                            <option value="full_time" @selected(old('employment_type', $teacher->employment_type ?? 'full_time') === 'full_time')>Full time</option>
                            <option value="part_time" @selected(old('employment_type', $teacher->employment_type) === 'part_time')>Part time</option>
                            <option value="contract" @selected(old('employment_type', $teacher->employment_type) === 'contract')>Contract</option>
                        </select>
                        @error('employment_type')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="hire_date">Hire date</label>
                        <input id="hire_date" name="hire_date" type="date" value="{{ old('hire_date', $teacher->hire_date?->format('Y-m-d')) }}">
                        @error('hire_date')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required>
                            <option value="active" @selected(old('status', $teacher->status ?? 'active') === 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $teacher->status) === 'inactive')>Inactive</option>
                        </select>
                        @error('status')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field field-full">
                        <label for="address">Address</label>
                        <textarea id="address" name="address" rows="3" maxlength="2000">{{ old('address', $teacher->address) }}</textarea>
                        @error('address')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field field-full">
                        <label for="notes">Administrative notes</label>
                        <textarea id="notes" name="notes" rows="3" maxlength="5000">{{ old('notes', $teacher->notes) }}</textarea>
                        @error('notes')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="actions">
                    <button class="btn" type="submit">{{ $teacher->exists ? 'Save Changes' : 'Register Teacher' }}</button>
                    <a class="btn btn-light" href="{{ route('admin.teachers.index') }}">Cancel</a>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection
