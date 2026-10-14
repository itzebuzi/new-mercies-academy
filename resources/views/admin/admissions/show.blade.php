@extends('layouts.admin')

@section('page-title', 'Review Application')

@section('content')
<style>
    .review-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(280px, .8fr);
        gap: 20px;
        align-items: start;
    }

    .review-panel {
        overflow: hidden;
        border: 1px solid #e3e9f2;
        border-radius: 10px;
        background: #fff;
    }

    .review-heading {
        padding: 20px 22px;
        border-bottom: 1px solid #e3e9f2;
    }

    .review-heading h2 { margin: 0; font-size: 17px; }

    .review-body { padding: 22px; }

    .detail-row {
        display: grid;
        grid-template-columns: 140px minmax(0, 1fr);
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid #edf0f5;
        font-size: 13px;
    }

    .detail-row:last-child { border-bottom: 0; }

    .detail-label { color: #718096; }
    .detail-value { color: #17243a; font-weight: 600; overflow-wrap: anywhere; }

    .field-label {
        display: block;
        margin: 18px 0 7px;
        color: #344054;
        font-size: 12px;
        font-weight: 600;
    }

    .field-control {
        width: 100%;
        min-height: 44px;
        padding: 10px 12px;
        border: 1px solid #d7dfeb;
        border-radius: 6px;
        background: #fff;
        color: #17243a;
    }

    textarea.field-control { min-height: 140px; resize: vertical; }

    .primary-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 11px 17px;
        border: 0;
        border-radius: 5px;
        background: #123c80;
        color: white;
        cursor: pointer;
        font-weight: 600;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 18px;
        color: #164b9a;
        font-size: 13px;
        font-weight: 600;
    }

    .application-reference {
        margin-top: 8px;
        color: #718096;
        font-size: 12px;
    }

    @media (max-width: 850px) {
        .review-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 480px) {
        .review-body { padding: 16px; }
        .detail-row { grid-template-columns: 1fr; gap: 5px; }
    }
</style>

<a class="back-link" href="{{ route('admin.admissions.index') }}">
    ← Back to admissions
</a>

<div class="review-grid">
    <section class="review-panel">
        <div class="review-heading">
            <h2>Student application</h2>
            <div class="application-reference">
                Reference: {{ $admission->application_reference }}
            </div>
        </div>

        <div class="review-body">
            <div class="detail-row">
                <div class="detail-label">Student's full name</div>
                <div class="detail-value">
                    {{ $admission->first_name }}
                    {{ $admission->middle_name }}
                    {{ $admission->last_name }}
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Date of birth</div>
                <div class="detail-value">
                    {{ $admission->date_of_birth?->format('d F Y') ?? 'Not provided' }}
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Gender</div>
                <div class="detail-value">{{ $admission->gender ?: 'Not provided' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Class applying for</div>
                <div class="detail-value">{{ $admission->class_applying_for }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Previous school</div>
                <div class="detail-value">{{ $admission->previous_school ?: 'Not provided' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Guardian's name</div>
                <div class="detail-value">{{ $admission->guardian_name }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Relationship</div>
                <div class="detail-value">{{ $admission->guardian_relationship ?: 'Not provided' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Guardian's email</div>
                <div class="detail-value">{{ $admission->guardian_email }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Guardian's phone</div>
                <div class="detail-value">{{ $admission->guardian_phone }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Home address</div>
                <div class="detail-value">{{ $admission->address ?: 'Not provided' }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Submitted on</div>
                <div class="detail-value">{{ $admission->created_at->format('d F Y, h:i A') }}</div>
            </div>
        </div>
    </section>

    <section class="review-panel">
        <div class="review-heading">
            <h2>Review decision</h2>
        </div>

        <div class="review-body">
            <p style="margin:0;color:#718096;font-size:13px;line-height:1.7">
                Update the application status and add notes for school administrators.
                These notes are internal and are not shown on the public application page.
            </p>

            <form method="POST"
                  action="{{ route('admin.admissions.status', $admission) }}">
                @csrf
                @method('PATCH')

                <label class="field-label" for="status">Application status</label>
                <select class="field-control" id="status" name="status" required>
                    <option value="pending" @selected(old('status', $admission->status) === 'pending')>Pending</option>
                    <option value="reviewing" @selected(old('status', $admission->status) === 'reviewing')>Under review</option>
                    <option value="accepted" @selected(old('status', $admission->status) === 'accepted')>Accepted</option>
                    <option value="rejected" @selected(old('status', $admission->status) === 'rejected')>Rejected</option>
                </select>

                <label class="field-label" for="admin_notes">Internal notes</label>
                <textarea class="field-control"
                          id="admin_notes"
                          name="admin_notes"
                          maxlength="5000"
                          placeholder="Record any review notes here...">{{ old('admin_notes', $admission->admin_notes) }}</textarea>

                <button class="primary-button" type="submit" style="width:100%;margin-top:20px">
                    Save review
                </button>
            </form>
        </div>
    </section>
</div>
@endsection