@extends('layouts.admin')

@section('content')
<div style="max-width:1200px;margin:auto;color:#172554">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:24px">
        <div>
            <h1 style="font-size:28px;font-weight:800;margin:0">Classes Management</h1>
            <p style="color:#64748b;margin-top:6px">Create and manage New Mercies Academy classes.</p>
        </div>
        <a href="{{ route('admin.classes.create') }}" style="background:#1d4ed8;color:white;padding:12px 18px;border-radius:9px;text-decoration:none;font-weight:700">+ Add Class</a>
    </div>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:13px 16px;border-radius:8px;margin-bottom:18px">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:13px 16px;border-radius:8px;margin-bottom:18px">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:22px">
        <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:20px"><div style="color:#64748b;font-size:13px">Total Classes</div><div style="font-size:28px;font-weight:800;margin-top:7px">{{ $totalClasses }}</div></div>
        <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:20px"><div style="color:#64748b;font-size:13px">Active Classes</div><div style="font-size:28px;font-weight:800;color:#15803d;margin-top:7px">{{ $activeClasses }}</div></div>
        <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:20px"><div style="color:#64748b;font-size:13px">Inactive Classes</div><div style="font-size:28px;font-weight:800;color:#b91c1c;margin-top:7px">{{ $inactiveClasses }}</div></div>
    </div>

    <form method="GET" action="{{ route('admin.classes.index') }}" style="display:flex;gap:10px;flex-wrap:wrap;background:white;border:1px solid #dbeafe;border-radius:12px;padding:16px;margin-bottom:18px">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search class or section..." style="flex:1;min-width:180px;padding:11px;border:1px solid #cbd5e1;border-radius:8px">
        <select name="level" style="padding:11px;border:1px solid #cbd5e1;border-radius:8px">
            <option value="">All levels</option>
            <option value="primary" @selected(request('level')==='primary')>Primary</option>
            <option value="junior_secondary" @selected(request('level')==='junior_secondary')>Junior Secondary</option>
            <option value="senior_secondary" @selected(request('level')==='senior_secondary')>Senior Secondary</option>
        </select>
        <select name="status" style="padding:11px;border:1px solid #cbd5e1;border-radius:8px">
            <option value="">All statuses</option>
            <option value="active" @selected(request('status')==='active')>Active</option>
            <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
        </select>
        <button style="background:#1d4ed8;color:white;border:0;padding:11px 18px;border-radius:8px;font-weight:700;cursor:pointer">Filter</button>
        <a href="{{ route('admin.classes.index') }}" style="padding:11px;color:#1d4ed8;text-decoration:none">Reset</a>
    </form>

    <div style="background:white;border:1px solid #dbeafe;border-radius:12px;overflow-x:auto">
        <table style="width:100%;border-collapse:collapse;min-width:760px">
            <thead style="background:#eff6ff">
                <tr>
                    @foreach(['Class','Level','Section','Capacity','Status','Actions'] as $heading)
                        <th style="text-align:left;padding:14px;border-bottom:1px solid #dbeafe;font-size:12px;color:#1e3a8a;text-transform:uppercase">{{ $heading }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @forelse($classes as $schoolClass)
                <tr>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0;font-weight:700">{{ $schoolClass->name }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0">{{ ['primary'=>'Primary','junior_secondary'=>'Junior Secondary','senior_secondary'=>'Senior Secondary'][$schoolClass->level] ?? $schoolClass->level }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0">{{ $schoolClass->section ?: '—' }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0">{{ $schoolClass->capacity }}</td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0"><span style="padding:5px 9px;border-radius:20px;font-size:12px;background:{{ $schoolClass->is_active ? '#dcfce7' : '#fee2e2' }};color:{{ $schoolClass->is_active ? '#166534' : '#991b1b' }}">{{ $schoolClass->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td style="padding:14px;border-bottom:1px solid #e2e8f0;white-space:nowrap">
                        <a href="{{ route('admin.classes.show',$schoolClass) }}" style="color:#1d4ed8;text-decoration:none;margin-right:9px">View</a>
                        <a href="{{ route('admin.classes.edit',$schoolClass) }}" style="color:#475569;text-decoration:none;margin-right:9px">Edit</a>
                        <form method="POST" action="{{ route('admin.classes.status',$schoolClass) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <button style="border:0;background:none;color:{{ $schoolClass->is_active ? '#b91c1c' : '#15803d' }};cursor:pointer">{{ $schoolClass->is_active ? 'Deactivate' : 'Activate' }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="padding:36px;text-align:center;color:#64748b">No classes have been added yet. Select “Add Class” to create your first class.</td></tr>
            @endforelse
            </tbody>
        </table>
        <div style="padding:16px">{{ $classes->links() }}</div>
    </div>
</div>
@endsection
