@extends('layouts.admin')

@section('page-title', 'Staff Details')

@section('content')
<style>
.staff-details{max-width:1000px;color:#34435a}
.staff-details .heading{display:flex;align-items:center;justify-content:space-between;gap:15px;flex-wrap:wrap;margin-bottom:22px}
.staff-details h2{color:#123b78;font-size:29px;font-weight:500;margin:0 0 7px}
.staff-details .muted{color:#718096;font-size:13px}
.staff-details .panel{background:white;border:1px solid #e0e7f1;border-radius:11px;overflow:hidden}
.staff-details .panel-title{padding:20px 24px;border-bottom:1px solid #e7edf5;color:#123b78;font-weight:700}
.staff-details .body{padding:24px}
.staff-details .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:23px}
.staff-details .label{color:#718096;font-size:12px;margin-bottom:7px}
.staff-details .value{font-size:14px;font-weight:600;overflow-wrap:anywhere}
.staff-details .btn{display:inline-block;padding:11px 17px;background:#163f80;color:white;border-radius:7px;font-size:13px;font-weight:700;border:0;cursor:pointer}
.staff-details .btn-light{background:#edf2fa;color:#123b78}
.staff-details .actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:25px}
.staff-details .status{display:inline-block;padding:6px 11px;border-radius:20px;background:#e1f7e9;color:#167647;font-size:11px;font-weight:700}
.staff-details .status.inactive{background:#fce8e8;color:#a12a2a}
@media(max-width:650px){.staff-details .grid{grid-template-columns:1fr}.staff-details .body{padding:17px}}
</style>

<div class="staff-details">
    <div class="heading">
        <div>
            <h2>{{ $staff->full_name }}</h2>
            <p class="muted">Staff number: {{ $staff->staff_number }}</p>
        </div>
        <a class="btn btn-light" href="{{ route('admin.staff.index') }}">← Back to Staff</a>
    </div>

    <section class="panel">
        <div class="panel-title">Staff Information</div>
        <div class="body">
            <div class="grid">
                <div><div class="label">Full name</div><div class="value">{{ $staff->full_name }}</div></div>
                <div><div class="label">Staff number</div><div class="value">{{ $staff->staff_number }}</div></div>
                <div><div class="label">Email</div><div class="value">{{ $staff->email }}</div></div>
                <div><div class="label">Phone</div><div class="value">{{ $staff->phone ?: 'Not provided' }}</div></div>
                <div><div class="label">Department</div><div class="value">{{ $staff->department }}</div></div>
                <div><div class="label">Position</div><div class="value">{{ $staff->position }}</div></div>
                <div><div class="label">Employment type</div><div class="value">{{ ucwords(str_replace('_', ' ', $staff->employment_type)) }}</div></div>
                <div><div class="label">Hire date</div><div class="value">{{ $staff->hire_date?->format('d F Y') ?? 'Not provided' }}</div></div>
                <div><div class="label">Salary</div><div class="value">{{ $staff->salary !== null ? number_format((float) $staff->salary, 2) : 'Not provided' }}</div></div>
                <div><div class="label">Status</div><div><span class="status {{ $staff->status === 'inactive' ? 'inactive' : '' }}">{{ ucfirst($staff->status) }}</span></div></div>
                <div><div class="label">Address</div><div class="value">{{ $staff->address ?: 'Not provided' }}</div></div>
                <div><div class="label">Notes</div><div class="value">{{ $staff->notes ?: 'No notes' }}</div></div>
            </div>

            <div class="actions">
                <a class="btn" href="{{ route('admin.staff.edit', $staff) }}">Edit Staff</a>

                <form method="POST" action="{{ route('admin.staff.status', $staff) }}">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-light" type="submit">
                        {{ $staff->status === 'active' ? 'Deactivate Staff' : 'Activate Staff' }}
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
