@extends('layouts.admin')

@section('page-title', 'Teacher Details')

@section('content')
<style>
.teacher-details{max-width:1000px;color:#34435a}
.teacher-details .heading{display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap;margin-bottom:22px}
.teacher-details h2{color:#123b78;font-size:29px;font-weight:500;margin:0 0 7px}
.teacher-details .muted{color:#718096;font-size:13px}
.teacher-details .panel{background:white;border:1px solid #e0e7f1;border-radius:11px;overflow:hidden}
.teacher-details .panel-title{padding:20px 24px;border-bottom:1px solid #e7edf5;color:#123b78;font-weight:700}
.teacher-details .body{padding:24px}
.teacher-details .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:23px}
.teacher-details .label{color:#718096;font-size:12px;margin-bottom:7px}
.teacher-details .value{font-size:14px;font-weight:600;overflow-wrap:anywhere}
.teacher-details .btn{display:inline-block;padding:11px 17px;background:#163f80;color:white;border-radius:7px;font-size:13px;font-weight:700;border:0;cursor:pointer}
.teacher-details .btn-light{background:#edf2fa;color:#123b78}
.teacher-details .actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:25px}
.teacher-details .status{display:inline-block;padding:6px 11px;border-radius:20px;background:#e1f7e9;color:#167647;font-size:11px;font-weight:700}
.teacher-details .status.inactive{background:#fce8e8;color:#a12a2a}
@media(max-width:650px){.teacher-details .grid{grid-template-columns:1fr}.teacher-details .body{padding:17px}}
</style>

<div class="teacher-details">
    <div class="heading">
        <div>
            <h2>{{ $teacher->full_name }}</h2>
            <p class="muted">Teacher number: {{ $teacher->teacher_number }}</p>
        </div>
        <a class="btn btn-light" href="{{ route('admin.teachers.index') }}">← Back to Teachers</a>
    </div>

    <section class="panel">
        <div class="panel-title">Teacher Information</div>
        <div class="body">
            <div class="grid">
                <div><div class="label">Full name</div><div class="value">{{ $teacher->full_name }}</div></div>
                <div><div class="label">Teacher number</div><div class="value">{{ $teacher->teacher_number }}</div></div>
                <div><div class="label">Email</div><div class="value">{{ $teacher->email ?: 'Not provided' }}</div></div>
                <div><div class="label">Phone</div><div class="value">{{ $teacher->phone ?: 'Not provided' }}</div></div>
                <div><div class="label">Gender</div><div class="value">{{ $teacher->gender ? ucfirst($teacher->gender) : 'Not provided' }}</div></div>
                <div><div class="label">Qualification</div><div class="value">{{ $teacher->qualification ?: 'Not provided' }}</div></div>
                <div><div class="label">Specialization</div><div class="value">{{ $teacher->specialization ?: 'Not assigned' }}</div></div>
                <div><div class="label">Assigned class</div><div class="value">{{ $teacher->assigned_class ?: 'Not assigned' }}</div></div>
                <div><div class="label">Employment type</div><div class="value">{{ ucwords(str_replace('_', ' ', $teacher->employment_type)) }}</div></div>
                <div><div class="label">Hire date</div><div class="value">{{ $teacher->hire_date?->format('d F Y') ?? 'Not provided' }}</div></div>
                <div><div class="label">Status</div><div><span class="status {{ $teacher->status === 'inactive' ? 'inactive' : '' }}">{{ ucfirst($teacher->status) }}</span></div></div>
                <div><div class="label">Address</div><div class="value">{{ $teacher->address ?: 'Not provided' }}</div></div>
                <div style="grid-column:1/-1"><div class="label">Administrative notes</div><div class="value">{{ $teacher->notes ?: 'No notes' }}</div></div>
            </div>

            <div class="actions">
                <a class="btn" href="{{ route('admin.teachers.edit', $teacher) }}">Edit Teacher</a>

                <form method="POST" action="{{ route('admin.teachers.status', $teacher) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-light" type="submit">
                        {{ $teacher->status === 'active' ? 'Deactivate Teacher' : 'Activate Teacher' }}
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
