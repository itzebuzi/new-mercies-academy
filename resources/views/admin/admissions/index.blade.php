@extends('layouts.admin')

@section('page-title', 'Admissions')

@section('content')
<style>
    .admission-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 25px;
    }

    .stat-card, .panel {
        border: 1px solid #e3e9f2;
        border-radius: 10px;
        background: #fff;
    }

    .stat-card { padding: 20px; }

    .stat-label {
        color: #718096;
        font-size: 12px;
    }

    .stat-value {
        margin-top: 12px;
        color: #123c80;
        font-size: 28px;
        font-weight: 700;
    }

    .panel { overflow: hidden; }

    .panel-heading {
        padding: 20px 22px;
        border-bottom: 1px solid #e3e9f2;
    }

    .panel-heading h2 { margin: 0; font-size: 17px; }

    .table-wrap { overflow-x: auto; }

    .admission-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .admission-table th {
        padding: 13px 18px;
        background: #f7f9fc;
        color: #718096;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        white-space: nowrap;
    }

    .admission-table td {
        padding: 16px 18px;
        border-top: 1px solid #edf0f5;
        font-size: 13px;
        vertical-align: middle;
    }

    .student-name { font-weight: 600; color: #17243a; }

    .reference {
        margin-top: 4px;
        color: #718096;
        font-size: 11px;
    }

    .status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        background: #edf1f7;
        color: #4a5568;
        font-size: 11px;
        text-transform: capitalize;
    }

    .status-pending { background: #fff4d8; color: #8a5a00; }
    .status-reviewing { background: #e8f1ff; color: #164b9a; }
    .status-accepted { background: #e5f7ec; color: #17653a; }
    .status-rejected { background: #fdeaea; color: #a32929; }

    .view-link {
        color: #164b9a;
        font-weight: 600;
        white-space: nowrap;
    }

    .empty-state {
        padding: 45px 20px;
        color: #718096;
        text-align: center;
    }

    .pagination { padding: 18px; }

    @media (max-width: 900px) {
        .admission-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 450px) {
        .admission-stats { gap: 10px; }
        .stat-card { padding: 14px; }
        .stat-value { font-size: 23px; }
    }
</style>

<div class="admission-stats">
    <div class="stat-card">
        <div class="stat-label">Total applications</div>
        <div class="stat-value">{{ $totalApplications }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Pending review</div>
        <div class="stat-value">{{ $pendingApplications }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Accepted</div>
        <div class="stat-value">{{ $acceptedApplications }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Rejected</div>
        <div class="stat-value">{{ $rejectedApplications }}</div>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <h2>Admission applications</h2>
        <p style="margin:7px 0 0;color:#718096;font-size:12px">
            Review submitted applications and update their status.
        </p>
    </div>

    @if ($admissions->isEmpty())
        <div class="empty-state">
            <h3 style="margin:0 0 8px;color:#17243a">No applications yet</h3>
            <p style="margin:0">New applications will appear here after a parent submits the admissions form.</p>
        </div>
    @else
        <div class="table-wrap">
            <table class="admission-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Guardian</th>
                        <th>Date received</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admissions as $admission)
                        <tr>
                            <td>
                                <div class="student-name">
                                    {{ $admission->first_name }} {{ $admission->last_name }}
                                </div>
                                <div class="reference">
                                    {{ $admission->application_reference }}
                                </div>
                            </td>
                            <td>{{ $admission->class_applying_for }}</td>
                            <td>
                                <div>{{ $admission->guardian_name }}</div>
                                <div class="reference">{{ $admission->guardian_phone }}</div>
                            </td>
                            <td>{{ $admission->created_at->format('d M Y') }}</td>
                            <td>
                                <span class="status status-{{ $admission->status }}">
                                    {{ $admission->status }}
                                </span>
                            </td>
                            <td>
                                <a class="view-link"
                                   href="{{ route('admin.admissions.show', $admission) }}">
                                    Review application →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $admissions->links() }}
        </div>
    @endif
</div>
@endsection