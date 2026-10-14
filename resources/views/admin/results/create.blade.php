@extends('layouts.admin')

@section('content')
<style>
    .result-form-page {
        max-width: 1050px;
        margin: 0 auto;
        color: #172b4d;
    }

    .result-form-page * {
        box-sizing: border-box;
    }

    .result-form-page .form-heading {
        margin-bottom: 25px;
    }

    .result-form-page .eyebrow {
        color: #5375ac;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .result-form-page h1 {
        color: #102e5b;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 750;
        letter-spacing: -.6px;
        margin: 0 0 9px;
    }

    .result-form-page .subtitle {
        color: #71819b;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    .result-form-page .form-card {
        background: #fff;
        border: 1px solid #e0e7f1;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 25px rgba(20, 47, 87, .045);
    }

    .result-form-page .form-card-heading {
        padding: 22px 26px;
        background: #fff;
        border-bottom: 1px solid #e9eef5;
    }

    .result-form-page .form-card-heading h2 {
        color: #183964;
        font-size: 17px;
        font-weight: 750;
        margin: 0 0 6px;
    }

    .result-form-page .form-card-heading p {
        color: #8492a7;
        font-size: 12px;
        line-height: 1.6;
        margin: 0;
    }

    .result-form-page .form-body {
        padding: 26px;
    }

    .result-form-page .section-title {
        color: #234a7b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin: 0 0 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf1f6;
    }

    .result-form-page .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px 20px;
    }

    .result-form-page .field {
        min-width: 0;
    }

    .result-form-page .field label {
        display: block;
        color: #405571;
        font-size: 12px;
        font-weight: 750;
        margin-bottom: 8px;
    }

    .result-form-page .required {
        color: #c34450;
    }

    .result-form-page .control {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 13px;
        border: 1px solid #dce4ef;
        border-radius: 9px;
        color: #243c5d;
        background-color: #fff;
        font-family: inherit;
        font-size: 13px;
        line-height: 1.4;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .result-form-page .control:focus {
        border-color: #4977b8;
        box-shadow: 0 0 0 3px rgba(73, 119, 184, .12);
    }

    .result-form-page .control::placeholder {
        color: #9aa7b9;
    }

    .result-form-page select.control {
        cursor: pointer;
    }

    .result-form-page textarea.control {
        min-height: 115px;
        resize: vertical;
    }

    .result-form-page .field-help {
        color: #8492a7;
        font-size: 11px;
        line-height: 1.6;
        margin-top: 7px;
    }

    .result-form-page .score-note {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px 18px;
        margin-top: 25px;
        border: 1px solid #dce7f8;
        border-radius: 10px;
        background: #f3f7fe;
        color: #3b5a83;
        font-size: 12px;
        line-height: 1.8;
    }

    .result-form-page .score-note strong {
        color: #183e72;
    }

    .result-form-page .score-note-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: #e0eafb;
        color: #214f91;
        font-size: 16px;
        font-weight: 800;
    }

    .result-form-page .form-alert {
        padding: 14px 17px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        line-height: 1.7;
    }

    .result-form-page .form-alert-error {
        background: #fff0f0;
        border: 1px solid #f3d0d0;
        color: #9d2b35;
    }

    .result-form-page .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px 26px;
        border-top: 1px solid #e9eef5;
        background: #fbfcfe;
    }

    .result-form-page .actions-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .result-form-page .btn-primary,
    .result-form-page .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 11px 18px;
        border-radius: 9px;
        font-family: inherit;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .result-form-page .btn-primary {
        border: 1px solid #173f7a;
        color: #fff;
        background: #173f7a;
        box-shadow: 0 4px 12px rgba(23, 63, 122, .14);
    }

    .result-form-page .btn-primary:hover {
        color: #fff;
        background: #0e2c58;
        transform: translateY(-1px);
    }

    .result-form-page .btn-secondary {
        border: 1px solid #dce5f1;
        color: #3c5576;
        background: #fff;
    }

    .result-form-page .btn-secondary:hover {
        background: #f0f4fa;
    }

    @media (max-width: 650px) {
        .result-form-page .form-body {
            padding: 20px 17px;
        }

        .result-form-page .form-card-heading {
            padding: 20px 17px;
        }

        .result-form-page .form-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .result-form-page .form-actions {
            padding: 17px;
            align-items: stretch;
        }

        .result-form-page .actions-right {
            width: 100%;
        }

        .result-form-page .actions-right > * {
            flex: 1;
        }

        .result-form-page .form-actions > .btn-secondary {
            width: 100%;
        }
    }
</style>

<div class="result-form-page">
    <div class="form-heading">
        <div class="eyebrow">Academic Administration</div>
        <h1>Enter Student Result</h1>
        <p class="subtitle">
            Record a student's continuous assessment and examination scores.
        </p>
    </div>

    @if($errors->any())
        <div class="form-alert form-alert-error">
            <strong>Please check the following:</strong>
            <ul style="margin: 8px 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <div class="form-card-heading">
            <h2>Result Information</h2>
            <p>Complete all required fields. The total score and grade are calculated automatically.</p>
        </div>

        <form method="POST" action="{{ route('admin.results.store') }}">
            @csrf

            <div class="form-body">
                <h3 class="section-title">Student &amp; Academic Details</h3>

                <div class="form-grid">
                    <div class="field">
                        <label for="student_id">
                            Student <span class="required">*</span>
                        </label>
                        <select name="student_id" id="student_id" class="control" required>
                            <option value="">Choose a student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    @selected((string) old('student_id') === (string) $student->id)>
                                    {{ $student->student_number }} —
                                    {{ $student->first_name }} {{ $student->last_name }}
                                    ({{ $student->class_name }})
                                </option>
                            @endforeach
                        </select>
                        @if($students->isEmpty())
                            <div class="field-help">No active students are available. Check the Students Management page.</div>
                        @endif
                    </div>

                    <div class="field">
                        <label for="subject_id">
                            Subject <span class="required">*</span>
                        </label>
                        <select name="subject_id" id="subject_id" class="control" required>
                            <option value="">Choose a subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    @selected((string) old('subject_id') === (string) $subject->id)>
                                    {{ $subject->name }} ({{ $subject->code }})
                                </option>
                            @endforeach
                        </select>
                        @if($subjects->isEmpty())
                            <div class="field-help">No active subjects are available. Add a subject first.</div>
                        @endif
                    </div>

                    <div class="field">
                        <label for="academic_session">
                            Academic Session <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="academic_session"
                            id="academic_session"
                            class="control"
                            placeholder="e.g. 2026/2027"
                            value="{{ old('academic_session', '2026/2027') }}"
                            maxlength="20"
                            required
                        >
                        <div class="field-help">Enter the school year for this result.</div>
                    </div>

                    <div class="field">
                        <label for="term">
                            Academic Term <span class="required">*</span>
                        </label>
                        <select name="term" id="term" class="control" required>
                            @foreach($terms as $term)
                                <option value="{{ $term }}"
                                    @selected(old('term', 'First Term') === $term)>
                                    {{ $term }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h3 class="section-title" style="margin-top: 32px;">
                    Assessment &amp; Examination Scores
                </h3>

                <div class="form-grid">
                    <div class="field">
                        <label for="ca_score">
                            Continuous Assessment <span class="required">*</span>
                        </label>
                        <input
                            type="number"
                            name="ca_score"
                            id="ca_score"
                            class="control"
                            placeholder="Enter score from 0 to 40"
                            min="0"
                            max="40"
                            step="0.01"
                            value="{{ old('ca_score') }}"
                            required
                        >
                        <div class="field-help">Maximum score: 40 marks.</div>
                    </div>

                    <div class="field">
                        <label for="exam_score">
                            Examination Score <span class="required">*</span>
                        </label>
                        <input
                            type="number"
                            name="exam_score"
                            id="exam_score"
                            class="control"
                            placeholder="Enter score from 0 to 60"
                            min="0"
                            max="60"
                            step="0.01"
                            value="{{ old('exam_score') }}"
                            required
                        >
                        <div class="field-help">Maximum score: 60 marks.</div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label for="teacher_comment">Teacher's Comment <span style="color:#8492a7;">(Optional)</span></label>
                        <textarea
                            name="teacher_comment"
                            id="teacher_comment"
                            class="control"
                            rows="4"
                            maxlength="2000"
                            placeholder="Add feedback about the student's performance..."
                        >{{ old('teacher_comment') }}</textarea>
                    </div>
                </div>

                <div class="score-note">
                    <div class="score-note-icon">i</div>
                    <div>
                        <strong>Scoring &amp; grading</strong><br>
                        Continuous assessment (maximum 40) + examination (maximum 60)
                        = total out of 100. The system calculates the grade and performance
                        remark automatically when you save.
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.results.index') }}" class="btn-secondary">
                    Cancel
                </a>

                <div class="actions-right">
                    <button type="reset" class="btn-secondary">Clear Form</button>
                    <button type="submit" class="btn-primary">
                        Save Result &rarr;
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
