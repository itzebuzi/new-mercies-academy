@extends('layouts.admin')

@section('content')
<style>
    .result-edit-page {
        max-width: 1050px;
        margin: 0 auto;
        color: #172b4d;
    }

    .result-edit-page * { box-sizing: border-box; }

    .result-edit-page .eyebrow {
        color: #5375ac;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .result-edit-page h1 {
        color: #102e5b;
        font-size: clamp(25px, 3vw, 32px);
        font-weight: 750;
        margin: 0 0 9px;
    }

    .result-edit-page .subtitle {
        color: #71819b;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
    }

    .result-edit-page .page-heading {
        margin-bottom: 25px;
    }

    .result-edit-page .edit-card {
        background: #fff;
        border: 1px solid #e0e7f1;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 25px rgba(20, 47, 87, .045);
    }

    .result-edit-page .card-heading {
        padding: 22px 26px;
        border-bottom: 1px solid #e9eef5;
    }

    .result-edit-page .card-heading h2 {
        color: #183964;
        font-size: 17px;
        font-weight: 750;
        margin: 0 0 6px;
    }

    .result-edit-page .card-heading p {
        color: #8492a7;
        font-size: 12px;
        margin: 0;
        line-height: 1.7;
    }

    .result-edit-page .form-body {
        padding: 26px;
    }

    .result-edit-page .section-title {
        color: #234a7b;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin: 0 0 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf1f6;
    }

    .result-edit-page .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px 20px;
    }

    .result-edit-page .field { min-width: 0; }

    .result-edit-page label {
        display: block;
        color: #405571;
        font-size: 12px;
        font-weight: 750;
        margin-bottom: 8px;
    }

    .result-edit-page .required { color: #c34450; }

    .result-edit-page .control {
        display: block;
        width: 100%;
        min-height: 46px;
        padding: 12px 13px;
        border: 1px solid #dce4ef;
        border-radius: 9px;
        color: #243c5d;
        background: #fff;
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .result-edit-page .control:focus {
        border-color: #4977b8;
        box-shadow: 0 0 0 3px rgba(73, 119, 184, .12);
    }

    .result-edit-page textarea.control {
        min-height: 115px;
        resize: vertical;
    }

    .result-edit-page .help {
        color: #8492a7;
        font-size: 11px;
        margin-top: 7px;
        line-height: 1.6;
    }

    .result-edit-page .score-note {
        display: flex;
        gap: 12px;
        padding: 16px 18px;
        margin-top: 26px;
        border: 1px solid #dce7f8;
        border-radius: 10px;
        background: #f3f7fe;
        color: #3b5a83;
        font-size: 12px;
        line-height: 1.8;
    }

    .result-edit-page .alert {
        padding: 14px 17px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .result-edit-page .alert-danger {
        background: #fff0f0;
        border: 1px solid #f3d0d0;
        color: #9d2b35;
    }

    .result-edit-page .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 20px 26px;
        border-top: 1px solid #e9eef5;
        background: #fbfcfe;
    }

    .result-edit-page .action-group {
        display: flex;
        gap: 10px;
    }

    .result-edit-page .btn-primary,
    .result-edit-page .btn-secondary {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 44px;
        padding: 11px 18px;
        border-radius: 9px;
        font: inherit;
        font-size: 12px;
        font-weight: 750;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .result-edit-page .btn-primary {
        color: #fff;
        background: #173f7a;
        border: 1px solid #173f7a;
    }

    .result-edit-page .btn-primary:hover {
        color: #fff;
        background: #0e2c58;
        transform: translateY(-1px);
    }

    .result-edit-page .btn-secondary {
        color: #3c5576;
        background: #fff;
        border: 1px solid #dce5f1;
    }

    .result-edit-page .btn-secondary:hover { background: #f0f4fa; }

    @media (max-width: 650px) {
        .result-edit-page .form-body { padding: 20px 17px; }
        .result-edit-page .card-heading { padding: 20px 17px; }
        .result-edit-page .form-grid { grid-template-columns: 1fr; gap: 18px; }
        .result-edit-page .form-actions { padding: 17px; }
        .result-edit-page .action-group { width: 100%; }
        .result-edit-page .action-group > * { flex: 1; }
    }
</style>

<div class="result-edit-page">
    <div class="page-heading">
        <div class="eyebrow">Academic Administration</div>
        <h1>Edit Student Result</h1>
        <p class="subtitle">
            Update the academic record for
            <strong>{{ $result->student->first_name }} {{ $result->student->last_name }}</strong>.
        </p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following:</strong>
            <ul style="margin: 8px 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="edit-card">
        <div class="card-heading">
            <h2>Result Information</h2>
            <p>Review the student's details and update the scores below.</p>
        </div>

        <form method="POST" action="{{ route('admin.results.update', $result) }}">
            @csrf
            @method('PUT')

            <div class="form-body">
                <h3 class="section-title">Student &amp; Academic Details</h3>

                <div class="form-grid">
                    <div class="field">
                        <label for="student_id">Student <span class="required">*</span></label>
                        <select name="student_id" id="student_id" class="control" required>
                            <option value="">Choose a student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    @selected((string) old('student_id', $result->student_id) === (string) $student->id)>
                                    {{ $student->student_number }} — {{ $student->first_name }} {{ $student->last_name }}
                                    ({{ $student->class_name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label for="subject_id">Subject <span class="required">*</span></label>
                        <select name="subject_id" id="subject_id" class="control" required>
                            <option value="">Choose a subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    @selected((string) old('subject_id', $result->subject_id) === (string) $subject->id)>
                                    {{ $subject->name }} ({{ $subject->code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field">
                        <label for="academic_session">Academic Session <span class="required">*</span></label>
                        <input type="text" name="academic_session" id="academic_session"
                               class="control" maxlength="20" required
                               placeholder="e.g. 2026/2027"
                               value="{{ old('academic_session', $result->academic_session) }}">
                    </div>

                    <div class="field">
                        <label for="term">Academic Term <span class="required">*</span></label>
                        <select name="term" id="term" class="control" required>
                            @foreach($terms as $term)
                                <option value="{{ $term }}"
                                    @selected(old('term', $result->term) === $term)>
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
                        <label for="ca_score">Continuous Assessment <span class="required">*</span></label>
                        <input type="number" name="ca_score" id="ca_score" class="control"
                               min="0" max="40" step="0.01" required
                               value="{{ old('ca_score', $result->ca_score) }}">
                        <div class="help">Maximum: 40 marks.</div>
                    </div>

                    <div class="field">
                        <label for="exam_score">Examination Score <span class="required">*</span></label>
                        <input type="number" name="exam_score" id="exam_score" class="control"
                               min="0" max="60" step="0.01" required
                               value="{{ old('exam_score', $result->exam_score) }}">
                        <div class="help">Maximum: 60 marks.</div>
                    </div>

                    <div class="field" style="grid-column: 1 / -1;">
                        <label for="teacher_comment">Teacher's Comment <span style="color:#8492a7;">(Optional)</span></label>
                        <textarea name="teacher_comment" id="teacher_comment" class="control"
                                  rows="4" maxlength="2000"
                                  placeholder="Add feedback about the student's performance...">{{ old('teacher_comment', $result->teacher_comment) }}</textarea>
                    </div>
                </div>

                <div class="score-note">
                    <div aria-hidden="true"><strong>i</strong></div>
                    <div>
                        <strong>Scoring &amp; grading</strong><br>
                        Continuous assessment (maximum 40) plus examination (maximum 60)
                        gives a total out of 100. The grade and remark are recalculated when you save.
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.results.index') }}" class="btn-secondary">Back to Results</a>

                <div class="action-group">
                    <button type="reset" class="btn-secondary">Reset Changes</button>
                    <button type="submit" class="btn-primary">Update Result &rarr;</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
