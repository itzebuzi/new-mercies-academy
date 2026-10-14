@extends('layouts.admin')

@section('content')
<style>
    .result-view-page {
        max-width: 1100px;
        margin: 0 auto;
        color: #172b4d;
    }

    .result-view-page * { box-sizing: border-box; }

    .result-view-page .eyebrow {
        color: #5375ac;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .result-view-page h1 {
        color: #102e5b;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 750;
        margin: 0 0 9px;
    }

    .result-view-page .subtitle {
        color: #71819b;
        font-size: 14px;
        margin: 0;
        line-height: 1.7;
    }

    .result-view-page .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 25px;
    }

    .result-view-page .actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }

    .result-view-page .btn-primary,
    .result-view-page .btn-secondary {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-height: 42px;
        padding: 10px 16px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        transition: background .2s;
    }

    .result-view-page .btn-primary {
        background: #173f7a;
        border: 1px solid #173f7a;
        color: #fff;
    }

    .result-view-page .btn-primary:hover {
        color: #fff;
        background: #0e2c58;
    }

    .result-view-page .btn-secondary {
        background: #fff;
        border: 1px solid #dce5f1;
        color: #3c5576;
    }

    .result-view-page .btn-secondary:hover { background: #f0f4fa; }

    .result-view-page .info-card {
        background: #fff;
        border: 1px solid #e0e7f1;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 22px;
        box-shadow: 0 5px 22px rgba(20, 47, 87, .04);
    }

    .result-view-page .card-heading {
        padding: 20px 24px;
        border-bottom: 1px solid #e9eef5;
    }

    .result-view-page .card-heading h2 {
        color: #183964;
        font-size: 16px;
        font-weight: 750;
        margin: 0 0 6px;
    }

    .result-view-page .card-heading p {
        color: #8492a7;
        font-size: 12px;
        margin: 0;
        line-height: 1.6;
    }

    .result-view-page .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0;
    }

    .result-view-page .info-item {
        padding: 20px 24px;
        border-bottom: 1px solid #edf1f6;
        min-width: 0;
    }

    .result-view-page .info-item:nth-child(odd) {
        border-right: 1px solid #edf1f6;
    }

    .result-view-page .info-label {
        color: #8492a7;
        font-size: 11px;
        font-weight: 750;
        text-transform: uppercase;
        letter-spacing: .65px;
        margin-bottom: 8px;
    }

    .result-view-page .info-value {
        color: #213d61;
        font-size: 14px;
        font-weight: 650;
        overflow-wrap: anywhere;
    }

    .result-view-page .info-subtext {
        color: #8492a7;
        font-size: 11px;
        margin-top: 5px;
    }

    .result-view-page .performance-body {
        padding: 24px;
    }

    .result-view-page .score-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .result-view-page .score-card {
        border: 1px solid #e0e8f3;
        border-radius: 12px;
        padding: 20px;
        background: #fbfcff;
    }

    .result-view-page .score-label {
        color: #71819b;
        font-size: 11px;
        font-weight: 750;
        margin-bottom: 10px;
    }

    .result-view-page .score-value {
        color: #173e73;
        font-size: 25px;
        font-weight: 800;
        letter-spacing: -.6px;
    }

    .result-view-page .score-max {
        color: #8a98ab;
        font-size: 12px;
        font-weight: 500;
    }

    .result-view-page .score-total-card {
        background: #173f7a;
        border-color: #173f7a;
    }

    .result-view-page .score-total-card .score-label,
    .result-view-page .score-total-card .score-value,
    .result-view-page .score-total-card .score-max {
        color: #fff;
    }

    .result-view-page .grade-summary {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 20px;
        border-radius: 12px;
        background: #f0f5fd;
        border: 1px solid #dce7f8;
        margin-bottom: 24px;
    }

    .result-view-page .grade-letter {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        width: 66px;
        height: 66px;
        border-radius: 16px;
        background: #173f7a;
        color: #fff;
        font-size: 27px;
        font-weight: 850;
    }

    .result-view-page .grade-letter.grade-f {
        background: #a9313c;
    }

    .result-view-page .grade-title {
        color: #173c70;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .result-view-page .grade-description {
        color: #657994;
        font-size: 12px;
        line-height: 1.6;
    }

    .result-view-page .comment-box {
        padding: 19px 20px;
        border: 1px solid #e0e7f1;
        border-radius: 11px;
        background: #fff;
    }

    .result-view-page .comment-title {
        color: #405571;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 9px;
    }

    .result-view-page .comment-text {
        color: #61738e;
        font-size: 13px;
        line-height: 1.8;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    @media (max-width: 700px) {
        .result-view-page .info-grid { grid-template-columns: 1fr; }
        .result-view-page .info-item:nth-child(odd) { border-right: none; }
        .result-view-page .score-grid { grid-template-columns: 1fr; }
        .result-view-page .page-heading { align-items: flex-start; }
        .result-view-page .actions { width: 100%; }
        .result-view-page .actions > * { flex: 1; }
        .result-view-page .performance-body { padding: 17px; }
        .result-view-page .info-item { padding: 17px; }
    }
</style>

<div class="result-view-page">
    <div class="page-heading">
        <div>
            <div class="eyebrow">Academic Administration</div>
            <h1>Student Result</h1>
            <p class="subtitle">
                {{ $result->academic_session }} &middot; {{ $result->term }}
            </p>
        </div>

        <div class="actions">
            <a href="{{ route('admin.results.index') }}" class="btn-secondary">Back to Results</a>
            <a href="{{ route('admin.results.edit', $result) }}" class="btn-primary">Edit Result &rarr;</a>
        </div>
    </div>

    <div class="info-card">
        <div class="card-heading">
            <h2>Student Information</h2>
            <p>Student identity and subject details for this academic record.</p>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Student Name</div>
                <div class="info-value">
                    {{ $result->student->first_name }}
                    {{ $result->student->middle_name }}
                    {{ $result->student->last_name }}
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Student Number</div>
                <div class="info-value">{{ $result->student->student_number }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Class</div>
                <div class="info-value">{{ $result->student->class_name ?: 'Not specified' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Subject</div>
                <div class="info-value">{{ $result->subject->name }}</div>
                <div class="info-subtext">{{ $result->subject->code }}</div>
            </div>
        </div>
    </div>

    <div class="info-card">
        <div class="card-heading">
            <h2>Academic Performance</h2>
            <p>Score breakdown and automatically calculated grade.</p>
        </div>

        <div class="performance-body">
            <div class="score-grid">
                <div class="score-card">
                    <div class="score-label">Continuous Assessment</div>
                    <div class="score-value">
                        {{ number_format($result->ca_score, 2) }}
                        <span class="score-max">/ 40</span>
                    </div>
                </div>

                <div class="score-card">
                    <div class="score-label">Examination</div>
                    <div class="score-value">
                        {{ number_format($result->exam_score, 2) }}
                        <span class="score-max">/ 60</span>
                    </div>
                </div>

                <div class="score-card score-total-card">
                    <div class="score-label">Total Score</div>
                    <div class="score-value">
                        {{ number_format($result->total_score, 2) }}
                        <span class="score-max">/ 100</span>
                    </div>
                </div>
            </div>

            <div class="grade-summary">
                <div class="grade-letter {{ $result->grade === 'F' ? 'grade-f' : '' }}">
                    {{ $result->grade }}
                </div>
                <div>
                    <div class="grade-title">{{ $result->remark }}</div>
                    <div class="grade-description">
                        Final grade for {{ $result->term }},
                        {{ $result->academic_session }}.
                    </div>
                </div>
            </div>

            <div class="comment-box">
                <div class="comment-title">Teacher's Comment</div>
                <div class="comment-text">{{ $result->teacher_comment ?: 'No teacher comment has been added.' }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
