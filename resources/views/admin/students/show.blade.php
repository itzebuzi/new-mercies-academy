@extends('layouts.admin')

@section('page-title', 'Student Details')

@section('content')
<style>
.student-module{color:#34435a}.student-module .page-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px}.student-module h1{margin:0 0 7px;color:#123b78;font-size:clamp(25px,3vw,34px)}.student-module .muted{color:#68758a;font-size:13px;line-height:1.7}.student-module .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:11px 16px;border:0;border-radius:7px;background:#123b78;color:#fff;text-decoration:none;font-size:13px;font-weight:700;cursor:pointer}.student-module .btn:hover{background:#0a2650;color:#fff}.student-module .btn-light{background:#edf2fa;color:#123b78}.student-module .panel{background:#fff;border:1px solid #e3e9f2;border-radius:11px;overflow:hidden;margin-bottom:20px}.student-module .panel-head{padding:19px 22px;border-bottom:1px solid #edf0f5;color:#123b78;font-weight:750}.student-module .panel-body{padding:22px}.student-module .stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px;margin-bottom:22px}.student-module .stat{padding:19px;background:#fff;border:1px solid #e3e9f2;border-radius:10px}.student-module .stat span{display:block;color:#68758a;font-size:12px}.student-module .stat strong{display:block;margin-top:10px;color:#123b78;font-size:28px}.student-module .filters{display:flex;gap:10px;flex-wrap:wrap;padding:18px 22px;border-bottom:1px solid #edf0f5}.student-module input,.student-module select,.student-module textarea{width:100%;padding:11px 12px;border:1px solid #d8e1ef;border-radius:6px;background:#fff;color:#243247;font:inherit;font-size:13px}.student-module .filters input{flex:1;min-width:190px}.student-module .filters select{width:auto;min-width:160px}.student-module .table-wrap{overflow-x:auto}.student-module table{width:100%;border-collapse:collapse;min-width:700px}.student-module th,.student-module td{padding:14px 18px;border-bottom:1px solid #edf0f5;text-align:left;font-size:12px;vertical-align:middle}.student-module th{background:#f8faff;color:#68758a;font-size:10px;letter-spacing:.6px;text-transform:uppercase}.student-module td strong{color:#123b78}.student-module .pill{display:inline-block;padding:5px 9px;border-radius:99px;background:#e3f7eb;color:#17683a;font-size:10px;font-weight:800;text-transform:capitalize}.student-module .pill.inactive{background:#edf0f5;color:#68758a}.student-module .form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}.student-module .field label{display:block;margin-bottom:7px;color:#34435a;font-size:12px;font-weight:700}.student-module .field-full{grid-column:1/-1}.student-module .field-error{margin-top:5px;color:#b42318;font-size:11px}.student-module .actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:22px}.student-module .details{display:grid;grid-template-columns:1fr 1fr;gap:0 24px}.student-module .detail{padding:15px 0;border-bottom:1px solid #edf0f5;min-width:0}.student-module .detail span{display:block;color:#68758a;font-size:12px;margin-bottom:6px}.student-module .detail strong{overflow-wrap:anywhere;color:#243247;font-size:13px}.student-module .notice{padding:12px 15px;border-radius:7px;background:#e3f7eb;color:#17683a;font-size:13px;margin-bottom:18px}.student-module .errors{padding:12px 15px;border-radius:7px;background:#fde9e9;color:#a32b2b;font-size:13px;margin-bottom:18px}.student-module .empty{padding:32px;text-align:center;color:#68758a;font-size:13px}.student-module .pagination{padding:16px 22px}.student-module .pagination nav{display:flex;justify-content:space-between}.student-module .pagination a,.student-module .pagination span{margin-right:8px}
@media(max-width:720px){.student-module .stats{grid-template-columns:1fr}.student-module .form-grid,.student-module .details{grid-template-columns:1fr}.student-module .field-full{grid-column:auto}.student-module .panel-body{padding:16px}}
</style>
<div class="student-module">
    <div class="page-head">
        <div><h1>Student Details</h1><p class="muted">Student number: {{ $student->student_number }}</p></div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
            <a class="btn btn-light" href="{{ route('admin.students.index') }}">← Back to students</a>
            <a class="btn" href="{{ route('admin.students.edit', $student) }}">Edit Record</a>
        </div>
    </div>

    @if (session('success'))<div class="notice">{{ session('success') }}</div>@endif

    <section class="panel">
        <div class="panel-head">Student information</div>
        <div class="panel-body">
            <div class="details">
                <div class="detail"><span>Full name</span><strong>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</strong></div>
                <div class="detail"><span>Student number</span><strong>{{ $student->student_number }}</strong></div>
                <div class="detail"><span>Date of birth</span><strong>{{ $student->date_of_birth?->format('d M Y') ?? 'Not provided' }}</strong></div>
                <div class="detail"><span>Gender</span><strong>{{ $student->gender ? ucfirst($student->gender) : 'Not provided' }}</strong></div>
                <div class="detail"><span>Class</span><strong>{{ $student->class_name }}</strong></div>
                <div class="detail"><span>Enrolment date</span><strong>{{ $student->enrollment_date?->format('d M Y') ?? 'Not provided' }}</strong></div>
                <div class="detail"><span>Parent/guardian</span><strong>{{ $student->guardian_name }}</strong></div>
                <div class="detail"><span>Guardian phone</span><strong>{{ $student->guardian_phone }}</strong></div>
                <div class="detail"><span>Guardian email</span><strong>{{ $student->guardian_email ?: 'Not provided' }}</strong></div>
                <div class="detail"><span>Status</span><strong><span class="pill {{ $student->status === 'inactive' ? 'inactive' : '' }}">{{ $student->status }}</span></strong></div>
                <div class="detail" style="grid-column:1/-1"><span>Home address</span><strong>{{ $student->address ?: 'Not provided' }}</strong></div>
                <div class="detail"><span>Record created</span><strong>{{ $student->created_at?->format('d M Y, h:i A') }}</strong></div>
                <div class="detail"><span>Last updated</span><strong>{{ $student->updated_at?->format('d M Y, h:i A') }}</strong></div>
            </div>
        </div>
    </section>
</div>
@endsection
