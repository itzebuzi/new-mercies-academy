@extends('layouts.admin')

@section('content')
<div style="max-width:850px;margin:auto;color:#172554">
    <a href="{{ route('admin.subjects.index') }}" style="color:#1d4ed8;text-decoration:none">← Back to Subjects</a>
    <h1 style="font-size:28px;font-weight:800;margin:18px 0 6px">Add New Subject</h1>
    <p style="color:#64748b;margin-bottom:24px">Enter the subject information.</p>

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:14px;border-radius:8px;margin-bottom:18px">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
    @endif

    <form method="POST" action="{{ route('admin.subjects.store') }}" style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:24px">
        @csrf
        @include('admin.subjects.form-fields', ['subject' => $subject])
    </form>
</div>
@endsection
