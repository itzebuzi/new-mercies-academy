@extends('layouts.admin')

@section('page-title', $pageHeading ?? 'Register Student')

@section('content')
<style>
.student-form-page{color:#34435a;max-width:1050px;margin:0 auto}
.student-form-page .page-heading{margin-bottom:24px}
.student-form-page h1{font-size:30px;color:#123b78;margin:0 0 8px}
.student-form-page .muted{color:#68758a;font-size:13px;line-height:1.7}
.student-form-page .panel{background:#fff;border:1px solid #e3e9f2;border-radius:11px;margin-bottom:20px;overflow:hidden}
.student-form-page .panel-heading{padding:19px 22px;border-bottom:1px solid #edf0f5;color:#123b78;font-weight:750}
.student-form-page .panel-body{padding:24px}
.student-form-page .form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:20px}
.student-form-page .field label{display:block;margin-bottom:8px;color:#34435a;font-size:13px;font-weight:700}
.student-form-page .field input,.student-form-page .field select,.student-form-page .field textarea{display:block;width:100%;box-sizing:border-box;padding:12px;border:1px solid #d8e1ef;border-radius:7px;background:#fff;color:#243247;font:inherit;font-size:13px}
.student-form-page .field input:focus,.student-form-page .field select:focus,.student-form-page .field textarea:focus{outline:2px solid #b8d0f5;border-color:#2563eb}
.student-form-page .field-full{grid-column:1/-1}
.student-form-page .error{color:#b42318;font-size:12px;margin-top:6px}
.student-form-page .error-summary{padding:14px 18px;border-radius:7px;background:#fde9e9;color:#a32b2b;margin-bottom:20px;font-size:13px}
.student-form-page .required{color:#b42318}
.student-form-page .actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:25px}
.student-form-page .btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 18px;border:0;border-radius:7px;background:#123b78;color:#fff;text-decoration:none;font-size:13px;font-weight:700;cursor:pointer}
.student-form-page .btn:hover{background:#0a2650;color:#fff}
.student-form-page .btn-light{background:#edf2fa;color:#123b78}
.student-form-page .btn-light:hover{background:#dce7f7;color:#123b78}
@media(max-width:700px){.student-form-page .form-grid{grid-template-columns:1fr}.student-form-page .field-full{grid-column:auto}.student-form-page .panel-body{padding:16px}.student-form-page h1{font-size:25px}}
</style>

<div class="student-form-page">
    <div class="page-heading">
        <h1>{{ $pageHeading ?? 'Register Student' }}</h1>
        <p class="muted">Enter the student's details and parent or guardian information below.</p>
    </div>

    @if ($errors->any())
        <div class="error-summary">
            <strong>Please correct the following errors:</strong>
            <ul style="margin:8px 0 0;padding-left:20px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $formAction }}" method="POST">
        @csrf
        @if (strtoupper($formMethod ?? 'POST') !== 'POST')
            @method($formMethod)
        @endif

        <section class="panel">
            <div class="panel-heading">Student Information</div>
            <div class="panel-body">
                <div class="form-grid">
                    <div class="field">
                        <label for="first_name">First Name <span class="required">*</span></label>
                        <input id="first_name" name="first_name" type="text" maxlength="100" value="{{ old('first_name', $student->first_name) }}" required>
                        @error('first_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="middle_name">Middle Name</label>
                        <input id="middle_name" name="middle_name" type="text" maxlength="100" value="{{ old('middle_name', $student->middle_name) }}">
                        @error('middle_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="last_name">Last Name <span class="required">*</span></label>
                        <input id="last_name" name="last_name" type="text" maxlength="100" value="{{ old('last_name', $student->last_name) }}" required>
                        @error('last_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="date_of_birth">Date of Birth</label>
                        <input id="date_of_birth" name="date_of_birth" type="date" max="{{ now()->subDay()->format('Y-m-d') }}" value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}">
                        @error('date_of_birth')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="male" @selected(old('gender', $student->gender) === 'male')>Male</option>
                            <option value="female" @selected(old('gender', $student->gender) === 'female')>Female</option>
                            <option value="other" @selected(old('gender', $student->gender) === 'other')>Other</option>
                        </select>
                        @error('gender')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="class_name">Class <span class="required">*</span></label>
                        <select id="class_name" name="class_name" required>
                            <option value="">Select class</option>
                            @foreach (['Nursery 1', 'Nursery 2', 'Primary 1', 'Primary 2', 'Primary 3', 'Primary 4', 'Primary 5', 'Primary 6', 'JSS 1', 'JSS 2', 'JSS 3', 'SSS 1', 'SSS 2', 'SSS 3'] as $classOption)
                                <option value="{{ $classOption }}" @selected(old('class_name', $student->class_name) === $classOption)>{{ $classOption }}</option>
                            @endforeach
                        </select>
                        @error('class_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="enrollment_date">Enrollment Date</label>
                        <input id="enrollment_date" name="enrollment_date" type="date" value="{{ old('enrollment_date', $student->enrollment_date?->format('Y-m-d')) }}">
                        @error('enrollment_date')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    @if ($student->exists)
                        <div class="field">
                            <label for="status">Student Status <span class="required">*</span></label>
                            <select id="status" name="status" required>
                                <option value="active" @selected(old('status', $student->status) === 'active')>Active</option>
                                <option value="inactive" @selected(old('status', $student->status) === 'inactive')>Inactive</option>
                            </select>
                            @error('status')<div class="error">{{ $message }}</div>@enderror
                        </div>
                    @else
                        <input type="hidden" name="status" value="active">
                    @endif
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">Parent / Guardian Information</div>
            <div class="panel-body">
                <div class="form-grid">
                    <div class="field">
                        <label for="guardian_name">Parent / Guardian Name <span class="required">*</span></label>
                        <input id="guardian_name" name="guardian_name" type="text" maxlength="150" value="{{ old('guardian_name', $student->guardian_name) }}" required>
                        @error('guardian_name')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field">
                        <label for="guardian_phone">Guardian Phone <span class="required">*</span></label>
                        <input id="guardian_phone" name="guardian_phone" type="tel" maxlength="30" value="{{ old('guardian_phone', $student->guardian_phone) }}" required>
                        @error('guardian_phone')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field field-full">
                        <label for="guardian_email">Guardian Email</label>
                        <input id="guardian_email" name="guardian_email" type="email" maxlength="255" value="{{ old('guardian_email', $student->guardian_email) }}">
                        @error('guardian_email')<div class="error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field field-full">
                        <label for="address">Home Address</label>
                        <textarea id="address" name="address" rows="3" maxlength="2000">{{ old('address', $student->address) }}</textarea>
                        @error('address')<div class="error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="actions">
                    <button class="btn" type="submit">{{ $student->exists ? 'Save Changes' : 'Register Student' }}</button>
                    <a class="btn btn-light" href="{{ route('admin.students.index') }}">Cancel</a>
                </div>
            </div>
        </section>
    </form>
</div>
@endsection
