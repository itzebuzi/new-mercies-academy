@extends('layouts.admin')

@section('content')
<div style="max-width:850px;margin:auto;color:#172554">
    <a href="{{ route('admin.classes.index') }}" style="color:#1d4ed8;text-decoration:none">← Back to Classes</a>
    <h1 style="font-size:28px;font-weight:800;margin:18px 0 6px">Add New Class</h1>
    <p style="color:#64748b;margin-bottom:24px">Enter the class details below.</p>

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:14px;border-radius:8px;margin-bottom:18px">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.classes.store') }}" style="background:white;border:1px solid #dbeafe;border-radius:12px;padding:24px">
        @csrf
        @include('admin.classes.form-fields', ['schoolClass' => $schoolClass])
    </form>
</div>
@endsection
