@extends('layouts.admin')

@section('content')
<div style="max-width:900px;margin:auto;color:#172554">
    <a href="{{ route('admin.subjects.index') }}" style="color:#1d4ed8;text-decoration:none">← Back to Subjects</a>

    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;padding:13px;border-radius:8px;margin:18px 0">{{ session('success') }}</div>
    @endif

    <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin:20px 0">
        <div>
            <h1 style="font-size:28px;font-weight:800;margin:0">{{ $subject->name }}</h1>
            <p style="color:#64748b;margin-top:6px">Subject code: {{ $subject->code }}</p>
        </div>
        <a href="{{ route('admin.subjects.edit',$subject) }}" style="background:#1d4ed8;color:white;padding:12px 18px;border-radius:8px;text-decoration:none">Edit Subject</a>
    </div>

    <div style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:24px">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:24px">
            <div><div style="color:#64748b;font-size:13px">Subject Name</div><strong>{{ $subject->name }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Subject Code</div><strong>{{ $subject->code }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Status</div><strong>{{ $subject->is_active ? 'Active' : 'Inactive' }}</strong></div>
            <div><div style="color:#64748b;font-size:13px">Created</div><strong>{{ $subject->created_at->format('d M Y') }}</strong></div>
        </div>

        <div style="margin-top:24px">
            <div style="color:#64748b;font-size:13px;margin-bottom:6px">Description</div>
            <p style="white-space:pre-line">{{ $subject->description ?: 'No description provided.' }}</p>
        </div>

        <form method="POST" action="{{ route('admin.subjects.status',$subject) }}" style="margin-top:24px">
            @csrf @method('PATCH')
            <button style="background:{{ $subject->is_active ? '#fee2e2' : '#dcfce7' }};color:{{ $subject->is_active ? '#991b1b' : '#166534' }};border:0;padding:11px 16px;border-radius:8px;cursor:pointer">{{ $subject->is_active ? 'Deactivate Subject' : 'Activate Subject' }}</button>
        </form>
    </div>
</div>
@endsection
