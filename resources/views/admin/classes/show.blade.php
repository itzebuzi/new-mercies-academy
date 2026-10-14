@extends('layouts.admin')

@section('content')
<div style="max-width:900px;margin:auto;color:#172554">
    <a href="{{ route('admin.classes.index') }}" style="color:#1d4ed8;text-decoration:none">← Back to Classes</a>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:13px;border-radius:8px;margin:18px 0">{{ session('success') }}</div>
    @endif

    <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;flex-wrap:wrap;margin:20px 0">
        <div>
            <h1 style="font-size:28px;font-weight:800;margin:0">{{ $schoolClass->name }}</h1>
            <p style="color:#64748b;margin-top:6px">Class information</p>
        </div>
        <a href="{{ route('admin.classes.edit',$schoolClass) }}" style="background:#1d4ed8;color:white;padding:12px 18px;border-radius:8px;text-decoration:none">Edit Class</a>
    </div>

    <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:24px">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:24px">
            <div><div style="color:#64748b;font-size:13px">Class Name</div><strong>{{ $schoolClass->name }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Education Level</div><strong>{{ ['primary'=>'Primary','junior_secondary'=>'Junior Secondary','senior_secondary'=>'Senior Secondary'][$schoolClass->level] ?? $schoolClass->level }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Section</div><strong>{{ $schoolClass->section ?: 'Not specified' }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Capacity</div><strong>{{ $schoolClass->capacity }} students</strong></div>
            <div><div style="color:#64748b;font-size:13px">Status</div><strong>{{ $schoolClass->is_active ? 'Active' : 'Inactive' }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Created</div><strong>{{ $schoolClass->created_at->format('d M Y') }}</strong></div>
        </div>
        <div style="margin-top:24px"><div style="color:#64748b;font-size:13px;margin-bottom:6px">Description</div><p style="white-space:pre-line">{{ $schoolClass->description ?: 'No description provided.' }}</p></div>

        <form method="POST" action="{{ route('admin.classes.status',$schoolClass) }}" style="margin-top:24px">
            @csrf @method('PATCH')
            <button style="background:{{ $schoolClass->is_active ? '#fee2e2' : '#dcfce7' }};color:{{ $schoolClass->is_active ? '#991b1b' : '#166534' }};border:0;padding:11px 16px;border-radius:8px;cursor:pointer">{{ $schoolClass->is_active ? 'Deactivate Class' : 'Activate Class' }}</button>
        </form>
    </div>
</div>
@endsection
