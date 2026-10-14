@extends('layouts.admin')

@section('content')
<style>
    .results-page {
        color: #172b4d;
        max-width: 1500px;
        margin: 0 auto;
        font-family: inherit;
    }

    .results-page * {
        box-sizing: border-box;
    }

    .results-page .results-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
        margin-bottom: 28px;
    }

    .results-page .results-eyebrow {
        color: #5375ac;
        text-transform: uppercase;
        letter-spacing: 1.8px;
        font-size: 11px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .results-page h1 {
        color: #102e5b;
        font-size: clamp(25px, 3vw, 34px);
        font-weight: 750;
        letter-spacing: -0.8px;
        margin: 0 0 9px;
    }

    .results-page .results-subtitle {
        color: #71819b;
        font-size: 14px;
        margin: 0;
        line-height: 1.6;
    }

    .results-page .results-primary,
    .results-page .results-secondary {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 43px;
        padding: 11px 17px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background .2s ease, transform .2s ease;
    }

    .results-page .results-primary {
        color: #fff;
        background: #173f7a;
        border: 1px solid #173f7a;
        box-shadow: 0 5px 14px rgba(23, 63, 122, .15);
    }

    .results-page .results-primary:hover {
        background: #0e2c58;
        color: #fff;
        transform: translateY(-1px);
    }

    .results-page .results-secondary {
        color: #284b7d;
        background: #fff;
        border: 1px solid #dce5f1;
    }

    .results-page .results-secondary:hover {
        background: #f1f5fb;
    }

    .results-page .results-alert {
        padding: 14px 17px;
        border-radius: 10px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .results-page .results-success {
        color: #176544;
        background: #eaf8f0;
        border: 1px solid #c7ebd7;
    }

    .results-page .results-error {
        color: #9d2b35;
        background: #fff0f0;
        border: 1px solid #f4d0d0;
    }

    .results-page .results-filter {
        background: #fff;
        border: 1px solid #e0e7f1;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 22px;
        box-shadow: 0 4px 18px rgba(20, 47, 87, .035);
    }

    .results-page .filter-title {
        color: #183964;
        font-size: 13px;
        font-weight: 750;
        margin: 0 0 15px;
    }

    .results-page .results-filter-grid {
        display: grid;
        grid-template-columns: minmax(200px, 1.5fr) minmax(170px, 1fr) minmax(150px, .8fr) auto;
        gap: 12px;
        align-items: end;
    }

    .results-page .results-field label {
        display: block;
        color: #536783;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .results-page .results-control {
        display: block;
        width: 100%;
        min-height: 43px;
        padding: 10px 12px;
        border: 1px solid #dce4ef;
        border-radius: 8px;
        background: #fff;
        color: #243c5d;
        font: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .results-page .results-control:focus {
        border-color: #4977b8;
        box-shadow: 0 0 0 3px rgba(73, 119, 184, .12);
    }

    .results-page .results-control::placeholder {
        color: #98a6b9;
    }

    .results-page .filter-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .results-page .results-table-card {
        background: #fff;
        border: 1px solid #e0e7f1;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(20, 47, 87, .035);
    }

    .results-page .table-topline {
        padding: 20px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid #e9eef5;
    }

    .results-page .table-topline h2 {
        color: #183964;
        font-size: 16px;
        font-weight: 750;
        margin: 0;
    }

    .results-page .results-count {
        color: #6e7f99;
        background: #f0f4fa;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 750;
        white-space: nowrap;
    }

    .results-page .results-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .results-page table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        min-width: 900px;
        margin: 0;
    }

    .results-page thead th {
        background: #f5f8fc;
        color: #61738e;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .7px;
        font-weight: 800;
        padding: 15px 16px;
        border-bottom: 1px solid #e4eaf3;
        white-space: nowrap;
    }

    .results-page tbody td {
        padding: 17px 16px;
        border-bottom: 1px solid #edf1f6;
        color: #415571;
        font-size: 12px;
        vertical-align: middle;
    }

    .results-page tbody tr:last-child td {
        border-bottom: none;
    }

    .results-page tbody tr:hover {
        background: #f8faff;
    }

    .results-page .student-name {
        color: #18375f;
        font-weight: 750;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .results-page .muted {
        color: #8594a9;
        font-size: 11px;
    }

    .results-page .subject-name {
        color: #304b70;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .results-page .score-total {
        color: #183d70;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .results-page .grade-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-width: 32px;
        padding: 6px 9px;
        border-radius: 7px;
        background: #e8effb;
        color: #214f91;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .results-page .grade-f {
        background: #fff0f0;
        color: #b33340;
    }

    .results-page .action-links {
        display: flex;
        gap: 7px;
    }

    .results-page .action-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dce5f1;
        border-radius: 7px;
        padding: 7px 10px;
        color: #254e84;
        background: #fff;
        font-size: 11px;
        font-weight: 750;
        text-decoration: none;
        transition: background .2s;
    }

    .results-page .action-link:hover {
        background: #edf3fc;
    }

    .results-page .empty-results {
        text-align: center;
        padding: 55px 20px;
    }

    .results-page .empty-icon {
        width: 62px;
        height: 62px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 18px;
        border-radius: 18px;
        background: #edf3fc;
        color: #244f89;
        font-size: 27px;
    }

    .results-page .empty-results h3 {
        color: #19395f;
        font-size: 18px;
        font-weight: 750;
        margin: 0 0 8px;
    }

    .results-page .empty-results p {
        color: #7b8ba2;
        font-size: 13px;
        line-height: 1.7;
        margin: 0 auto 20px;
        max-width: 420px;
    }

    .results-page .results-pagination {
        padding: 17px 20px;
        border-top: 1px solid #e9eef5;
        overflow-x: auto;
    }

    .results-page .results-pagination nav p {
        color: #71819b;
        font-size: 12px;
    }

    .results-page .results-pagination nav a,
    .results-page .results-pagination nav span {
        font-size: 12px;
    }

    @media (max-width: 1050px) {
        .results-page .results-filter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .results-page .results-heading {
            align-items: flex-start;
        }

        .results-page .results-heading > a {
            width: 100%;
        }

        .results-page .results-filter {
            padding: 15px;
        }

        .results-page .results-filter-grid {
            grid-template-columns: 1fr;
        }

        .results-page .filter-actions > * {
            flex: 1;
        }

        .results-page .table-topline {
            padding: 16px;
        }
    }
</style>

<div class="results-page">
    <div class="results-heading">
        <div>
            <div class="results-eyebrow">Academic Administration</div>
            <h1>Results &amp; Grades</h1>
            <p class="results-subtitle">
                Manage student performance, examination scores and term grades.
            </p>
        </div>

        <a href="{{ route('admin.results.create') }}" class="results-primary">
            <span aria-hidden="true">+</span> Enter Result
        </a>
    </div>

    @if(session('success'))
        <div class="results-alert results-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="results-alert results-error">
            <strong>Please correct the following:</strong>
            <ul style="margin: 8px 0 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="GET" action="{{ route('admin.results.index') }}" class="results-filter">
        <h2 class="filter-title">Find Student Results</h2>

        <div class="results-filter-grid">
            <div class="results-field">
                <label for="results-search">Student or Subject</label>
                <input
                    type="text"
                    id="results-search"
                    name="search"
                    class="results-control"
                    placeholder="Name, student number or subject"
                    value="{{ request('search') }}"
                >
            </div>

            <div class="results-field">
                <label for="results-session">Academic Session</label>
                <input
                    type="text"
                    id="results-session"
                    name="academic_session"
                    class="results-control"
                    placeholder="e.g. 2026/2027"
                    value="{{ request('academic_session') }}"
                >
            </div>

            <div class="results-field">
                <label for="results-term">Academic Term</label>
                <select id="results-term" name="term" class="results-control">
                    <option value="">All terms</option>
                    @foreach(['First Term', 'Second Term', 'Third Term'] as $term)
                        <option value="{{ $term }}" @selected(request('term') === $term)>
                            {{ $term }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-actions">
                <button type="submit" class="results-primary">Apply Filters</button>
                <a href="{{ route('admin.results.index') }}" class="results-secondary">Reset</a>
            </div>
        </div>
    </form>

    <div class="results-table-card">
        <div class="table-topline">
            <h2>Student Academic Records</h2>
            <span class="results-count">
                {{ $results->total() }} {{ $results->total() === 1 ? 'record' : 'records' }}
            </span>
        </div>

        <div class="results-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Session / Term</th>
                        <th>CA / 40</th>
                        <th>Exam / 60</th>
                        <th>Total</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($results as $result)
                        <tr>
                            <td>
                                <div class="student-name">
                                    {{ $result->student->first_name }}
                                    {{ $result->student->last_name }}
                                </div>
                                <div class="muted">
                                    {{ $result->student->student_number }}
                                </div>
                            </td>

                            <td>
                                <div class="subject-name">{{ $result->subject->name }}</div>
                                <div class="muted">{{ $result->subject->code }}</div>
                            </td>

                            <td>
                                <div>{{ $result->academic_session }}</div>
                                <div class="muted" style="margin-top: 5px;">
                                    {{ $result->term }}
                                </div>
                            </td>

                            <td>{{ number_format($result->ca_score, 2) }}</td>
                            <td>{{ number_format($result->exam_score, 2) }}</td>

                            <td>
                                <div class="score-total">
                                    {{ number_format($result->total_score, 2) }}/100
                                </div>
                            </td>

                            <td>
                                <span class="grade-badge {{ $result->grade === 'F' ? 'grade-f' : '' }}">
                                    {{ $result->grade }}
                                </span>
                                <div class="muted">{{ $result->remark }}</div>
                            </td>

                            <td>
                                <div class="action-links">
                                    <a href="{{ route('admin.results.show', $result) }}"
                                       class="action-link">View</a>
                                    <a href="{{ route('admin.results.edit', $result) }}"
                                       class="action-link">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-results">
                                    <div class="empty-icon" aria-hidden="true">▤</div>
                                    <h3>No results yet</h3>
                                    <p>
                                        Your student results will appear here after you enter
                                        assessment and examination scores. You can also change
                                        your search filters.
                                    </p>
                                    <a href="{{ route('admin.results.create') }}"
                                       class="results-primary">
                                        + Enter First Result
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($results->hasPages())
            <div class="results-pagination">
                {{ $results->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
