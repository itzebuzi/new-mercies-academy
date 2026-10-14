@extends('layouts.admin')

@section('page-title', 'School Dashboard')

@section('content')
<style>
    .school-dashboard { color: #243247; }
    .school-dashboard .dashboard-heading {
        display: flex; align-items: flex-start; justify-content: space-between;
        gap: 20px; margin-bottom: 26px; flex-wrap: wrap;
    }
    .school-dashboard .dashboard-heading h1 {
        margin: 0 0 8px; color: #123b78; font-size: clamp(25px, 3vw, 34px);
        line-height: 1.2; font-weight: 750;
    }
    .school-dashboard .dashboard-subtitle {
        margin: 0; color: #68758a; font-size: 14px; line-height: 1.7;
    }
    .school-dashboard .dashboard-primary-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        min-height: 44px; padding: 12px 17px; border-radius: 7px;
        background: #123b78; color: #fff; font-size: 13px; font-weight: 700;
        text-decoration: none;
    }
    .school-dashboard .dashboard-primary-btn:hover { background: #0a2650; color: #fff; }
    .school-dashboard .dashboard-stats {
        display: grid; grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 16px; margin-bottom: 28px;
    }
    .school-dashboard .dashboard-stat-card {
        min-width: 0; padding: 20px; border: 1px solid #e3e9f2;
        border-radius: 11px; background: #fff; box-shadow: 0 5px 18px rgba(18,59,120,.035);
    }
    .school-dashboard .stat-label { color: #68758a; font-size: 12px; font-weight: 650; line-height: 1.5; }
    .school-dashboard .stat-number { margin-top: 13px; color: #123b78; font-size: 30px; font-weight: 800; line-height: 1; }
    .school-dashboard .stat-note { margin-top: 10px; color: #8792a3; font-size: 11px; }
    .school-dashboard .dashboard-panel {
        overflow: hidden; border: 1px solid #e3e9f2; border-radius: 11px;
        background: #fff; box-shadow: 0 5px 18px rgba(18,59,120,.035);
    }
    .school-dashboard .panel-heading {
        display: flex; align-items: center; justify-content: space-between; gap: 15px;
        padding: 20px 22px; border-bottom: 1px solid #edf0f5; flex-wrap: wrap;
    }
    .school-dashboard .panel-heading h2 { margin: 0; color: #123b78; font-size: 17px; font-weight: 750; }
    .school-dashboard .panel-heading a { color: #123b78; font-size: 12px; font-weight: 750; text-decoration: none; }
    .school-dashboard .table-wrap { overflow-x: auto; }
    .school-dashboard table { width: 100%; border-collapse: collapse; min-width: 650px; }
    .school-dashboard th, .school-dashboard td { padding: 15px 22px; border-bottom: 1px solid #edf0f5; text-align: left; vertical-align: middle; }
    .school-dashboard th { background: #f8faff; color: #68758a; font-size: 10px; font-weight: 800; letter-spacing: .7px; text-transform: uppercase; }
    .school-dashboard td { color: #34435a; font-size: 12px; }
    .school-dashboard tbody tr:last-child td { border-bottom: 0; }
    .school-dashboard .applicant-name { color: #123b78; font-weight: 750; }
    .school-dashboard .applicant-ref { display: block; margin-top: 4px; color: #8792a3; font-size: 10px; }
    .school-dashboard .status-pill {
        display: inline-block; padding: 5px 9px; border-radius: 999px;
        background: #edf2fa; color: #3f587b; font-size: 10px; font-weight: 800; text-transform: capitalize;
    }
    .school-dashboard .status-pending { background: #fff4d9; color: #8a5b00; }
    .school-dashboard .status-reviewing { background: #e8f1ff; color: #2457a6; }
    .school-dashboard .status-accepted { background: #e3f7eb; color: #17683a; }
    .school-dashboard .status-rejected { background: #fde9e9; color: #a32b2b; }
    .school-dashboard .view-link { color: #123b78; font-weight: 750; text-decoration: none; }
    .school-dashboard .empty-state { padding: 36px 22px; color: #68758a; text-align: center; font-size: 13px; }
    @media (max-width: 1150px) { .school-dashboard .dashboard-stats { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
    @media (max-width: 700px) {
        .school-dashboard .dashboard-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 11px; }
        .school-dashboard .dashboard-stat-card { padding: 16px; }
        .school-dashboard .stat-number { font-size: 26px; }
        .school-dashboard .panel-heading { padding: 17px; }
    }
    @media (max-width: 390px) { .school-dashboard .dashboard-stats { grid-template-columns: 1fr; } }
</style>

<div class="school-dashboard">
    <div class="dashboard-heading">
        <div>
            <h1>School Dashboard</h1>
            <p class="dashboard-subtitle">Welcome to New Mercies Academy administration. Here is the latest admissions overview.</p>
        </div>
        <a href="{{ route('admin.admissions.index') }}" class="dashboard-primary-btn">
            Manage Admissions <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="dashboard-stats">
        <article class="dashboard-stat-card">
            <div class="stat-label">Total Applications</div>
            <div class="stat-number">{{ number_format($stats['total_applications']) }}</div>
            <div class="stat-note">All submitted applications</div>
        </article>
        <article class="dashboard-stat-card">
            <div class="stat-label">Pending Review</div>
            <div class="stat-number">{{ number_format($stats['pending_applications']) }}</div>
            <div class="stat-note">Awaiting an initial decision</div>
        </article>
        <article class="dashboard-stat-card">
            <div class="stat-label">Under Review</div>
            <div class="stat-number">{{ number_format($stats['reviewing_applications']) }}</div>
            <div class="stat-note">Currently being reviewed</div>
        </article>
        <article class="dashboard-stat-card">
            <div class="stat-label">Accepted</div>
            <div class="stat-number">{{ number_format($stats['accepted_applications']) }}</div>
            <div class="stat-note">Accepted applications</div>
        </article>
        <article class="dashboard-stat-card">
            <div class="stat-label">Rejected</div>
            <div class="stat-number">{{ number_format($stats['rejected_applications']) }}</div>
            <div class="stat-note">Unsuccessful applications</div>
        </article>
    </div>

    <section class="dashboard-panel">
        <div class="panel-heading">
            <h2>Recent Applications</h2>
            <a href="{{ route('admin.admissions.index') }}">View all applications →</a>
        </div>

        @if ($recentApplications->isEmpty())
            <div class="empty-state">
                No applications have been submitted yet. New applications will appear here.
            </div>
        @else
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>Class Applying For</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentApplications as $admission)
                            <tr>
                                <td>
                                    <span class="applicant-name">{{ $admission->first_name }} {{ $admission->last_name }}</span>
                                    <span class="applicant-ref">{{ $admission->application_reference }}</span>
                                </td>
                                <td>{{ $admission->class_applying_for }}</td>
                                <td>{{ $admission->created_at?->format('d M Y') ?? '—' }}</td>
                                <td>
                                    <span class="status-pill status-{{ $admission->status }}">
                                        {{ str_replace('_', ' ', $admission->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a class="view-link" href="{{ route('admin.admissions.show', $admission) }}">Review →</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
</div>
@endsection
