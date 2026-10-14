@extends('layouts.admin')

@section('page-title', 'Teachers')

@section('content')
<style>
.teacher-page{color:#34435a}
.teacher-page h2{font-size:30px;font-weight:500;color:#123b78;margin:0 0 8px}
.teacher-page .muted{color:#718096;font-size:13px}
.teacher-page .heading-row{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:25px}
.teacher-page .btn{display:inline-block;padding:12px 18px;border-radius:7px;background:#163f80;color:#fff;font-size:13px;font-weight:700;border:0;cursor:pointer}
.teacher-page .btn-light{background:#edf2fa;color:#123b78}
.teacher-page .stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;margin-bottom:25px}
.teacher-page .stat,.teacher-page .panel{background:#fff;border:1px solid #e0e7f1;border-radius:12px}
.teacher-page .stat{padding:24px}
.teacher-page .stat-label{font-size:13px;color:#718096}
.teacher-page .stat-number{font-size:34px;font-weight:700;color:#123b78;margin-top:14px}
.teacher-page .filters{display:flex;gap:12px;flex-wrap:wrap;padding:22px;border-bottom:1px solid #e7edf5}
.teacher-page input,.teacher-page select{min-height:44px;padding:10px 13px;border:1px solid #d5dfef;border-radius:7px;background:white;min-width:0}
.teacher-page input{flex:1;min-width:180px}
.teacher-page table{width:100%;border-collapse:collapse}
.teacher-page th,.teacher-page td{text-align:left;padding:17px 20px;border-bottom:1px solid #e7edf5;font-size:13px;vertical-align:middle}
.teacher-page th{background:#f8faff;color:#718096;font-size:11px;text-transform:uppercase;letter-spacing:.5px}
.teacher-page .person{font-weight:700;color:#173c70}
.teacher-page .pill{display:inline-block;border-radius:20px;padding:6px 11px;font-size:11px;font-weight:700;background:#e1f7e9;color:#167647}
.teacher-page .pill.inactive{background:#fce8e8;color:#a12a2a}
.teacher-page .empty{padding:45px 15px;text-align:center;color:#718096}
.teacher-page .table-wrap{overflow-x:auto}
.teacher-page .pagination{padding:18px}
@media(max-width:650px){.teacher-page .stats{grid-template-columns:1fr}.teacher-page .stat{padding:17px}.teacher-page th,.teacher-page td{padding:13px}}
</style>

<div class="teacher-page">
    <div class="heading-row">
        <div>
            <h2>Teacher Management</h2>
            <p class="muted">Register, find and maintain New Mercies Academy teacher records.</p>
        </div>
        <a class="btn" href="{{ route('admin.teachers.create') }}">+ Register Teacher</a>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-label">Total teachers</div>
            <div class="stat-number">{{ $stats['total'] }}</div>
        </div>
        <div class="stat">
            <div class="stat-label">Active teachers</div>
            <div class="stat-number">{{ $stats['active'] }}</div>
        </div>
        <div class="stat">
            <div class="stat-label">Inactive teachers</div>
            <div class="stat-number">{{ $stats['inactive'] }}</div>
        </div>
    </div>

    <div class="panel">
        <form method="GET" action="{{ route('admin.teachers.index') }}" class="filters">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search name, teacher number, email or subject">
            <select name="status">
                <option value="">All statuses</option>
                <option value="active" @selected(request('status') === 'active')>Active</option>
                <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
            </select>
            <button class="btn" type="submit">Search</button>
            <a class="btn btn-light" href="{{ route('admin.teachers.index') }}">Reset</a>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Teacher number</th>
                        <th>Specialization</th>
                        <th>Assigned class</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>
                                <div class="person">{{ $teacher->full_name }}</div>
                                <div class="muted">{{ $teacher->email ?: 'No email supplied' }}</div>
                            </td>
                            <td>{{ $teacher->teacher_number }}</td>
                            <td>{{ $teacher->specialization ?: '—' }}</td>
                            <td>{{ $teacher->assigned_class ?: '—' }}</td>
                            <td>
                                <span class="pill {{ $teacher->status === 'inactive' ? 'inactive' : '' }}">
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-light" href="{{ route('admin.teachers.show', $teacher) }}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">No teacher records found. Use “Register Teacher” to add the first teacher.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $teachers->links() }}</div>
    </div>
</div>
@endsection
