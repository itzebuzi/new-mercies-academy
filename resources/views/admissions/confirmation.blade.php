@extends('layouts.public')

@section('title', 'Application Received | New Mercies Academy')

@section('content')
<section style="padding:80px 0;background:#f5f8fd">
    <div class="school-shell">
        <div style="max-width:650px;margin:auto;padding:40px 25px;border:1px solid #e2e8f1;border-radius:12px;background:white;text-align:center">
            <div style="font-size:42px;color:#16834a">✓</div>

            <h1 style="color:#123b78;font-family:'Playfair Display',Georgia,serif">
                Application Received
            </h1>

            <p style="color:#68758a;line-height:1.9">
                Thank you for applying to New Mercies Academy.
                Your application has been recorded successfully.
            </p>

            <p style="margin:25px 0 8px;color:#68758a;font-size:12px">
                Your application reference
            </p>

            <p style="font-size:22px;font-weight:700;color:#123b78">
                {{ $admission->application_reference }}
            </p>

            <p style="color:#68758a;font-size:13px">
                Please save this reference for future enquiries.
            </p>

            <a href="{{ route('home') }}" class="bh-button" style="margin-top:15px">
                Return to Homepage
            </a>
        </div>
    </div>
</section>
@endsection