@extends('layouts.admin')

@section('content')
<div style="max-width:1200px;margin:auto;color:#172554">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:24px">
        <div>
            <h1 style="font-size:28px;font-weight:800;margin:0">Subjects Management</h1>
            <p style="color:#64748b;margin-top:6px">Manage subjects taught at New Mercies Academy.</p>
        </div>
        <a href="{{ route('admin.subjects.create') }}" style="background:#1d4ed8;color:white;padding:12px 18px;border-radius:9px;text-decoration:none;font-weight:700">+ Add Subject</a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:13px 16px;border-radius:8px;margin-bottom:18px">{{ session('success') }}</div>
    @endif

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:22px">
        <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:20px"><div style="color:#64748b;font-size:13px">Total Subjects</div><div style="font-size:28px;font-weight:800;margin-top:7px">{{ $totalSubjects }}</div></div>
        <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:20px"><div style="color:#64748b;font-size:13px">Active Subjects</div><div style="font-size:28px;font-weight:800;color:#15803d;margin-top:7px">{{ $activeSubjects }}</div></div>
        <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:20px"><div style="color:#64748b;font-size:13px">Inactive Subjects</div><div style="font-size:28px;font-weight:800;color:#b91c1c;margin-top:7px">{{ $inactiveSubjects }}</div></div>
    </div>

    <form method="GET" action="{{ route('admin.subjects.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;background:white;border:1px solid #dbeafe;border-radius:12px;padding:16px;margin-bottom:18px">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search subject name or code..." style="flex:1;min-width:180px;padding:11px;border:1px solid #cbd5e1;border-radius:8px">
        <select name="status" style="padding:11px;border:1px solid #cbd5e1;border-radius:8px">
            <option value="">All statuses</option>
            <option value="active" @selected(request('status')==='active')>Active</option>
            <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
        </select>
        <button style="background:#1d4ed8;color:white;border:0;padding:11px 18px;border-radius:8px;font-weight:700;cursor:pointer">Filter</button>
        <a href="{{ route('admin.subjects.index') }}" style="padding:11px;color:#1d4ed8;text-decoration:none">Reset</a>
    </form>

    <div style="background:white;border:1px solid #dbeafe;border-radius:12px;overflow-x:auto">
        <table style="width:100%;border-collapse:collapse;min-width:650px">
            <thead style="background:#eff6ff"><tr>
                @foreach(['Subject','Subject Code','Description','Status','Actions'] as $heading)
                    <th style="text-align:left;padding:14px;border-bottom:1px solid #dbeafe;font-size:12px;color:#1e3a8a;text-transform:uppercase">{{ $heading }}</th>
                @endforeach
            </tr></thead>
            <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0;font-weight:700">{{ $subject->name }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0">{{ $subject->code }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0">{{ \Illuminate\Support\Str::limit($subject->description ?: '—',60) }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0"><span style="padding:5px 9px;border-radius:20px;font-size:12px;background:{{ $subject->is_active ? '#dcfce7' : '#fee2e2' }};color:{{ $subject->is_active ? '#166534' : '#991b1b' }}">{{ $subject->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0;white-space:nowrap">
                        <a href="{{ route('admin.subjects.show',$subject) }}" style="color:#1d4ed8;text-decoration:none;margin-right:9px">View</a>
                        <a href="{{ route('admin.subjects.edit',$subject) }}" style="color:#475569;text-decoration:none;margin-right:9px">Edit</a>
                        <form method="POST" action="{{ route('admin.subjects.status',$subject) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <button style="border:0;background:none;color:{{ $subject->is_active ? '#b91c1c' : '#15803d' }};cursor:pointer">{{ $subject->is_active ? 'Deactivate' : 'Activate' }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" style="padding:36px;text-align:center;color:#64748b">No subjects have been added yet. Select “Add Subject” to create one.</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px">{{ $subjects->links() }}</div>
    </div>
</div>
@endsection
