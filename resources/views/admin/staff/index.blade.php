@extends('layouts.admin')

@section('page-title', 'Staff Management')

@section('content')
<div class="staff-page">
    <div class="staff-heading">
        <div>
            <span class="staff-eyebrow">BLUEHAVEN ACADEMY</span>
            <h1>Staff Management</h1>
            <p>Manage school employees, departments and employment records.</p>
        </div>

        <a href="{{ route('admin.staff.create') }}" class="staff-primary-button">
            <span>+</span> Register Staff
        </a>
    </div>

    @if (session('success'))
        <div class="staff-alert staff-alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="staff-alert staff-alert-error">{{ session('error') }}</div>
    @endif

    <div class="staff-stats">
        <article class="staff-stat-card">
            <span>Total Staff</span>
            <strong>{{ number_format($stats['total']) }}</strong>
            <small>All registered employees</small>
        </article>

        <article class="staff-stat-card">
            <span>Active Staff</span>
            <strong>{{ number_format($stats['active']) }}</strong>
            <small>Currently active employees</small>
        </article>

        <article class="staff-stat-card">
            <span>Inactive Staff</span>
            <strong>{{ number_format($stats['inactive']) }}</strong>
            <small>Currently inactive employees</small>
        </article>

        <article class="staff-stat-card">
            <span>Departments</span>
            <strong>{{ number_format($stats['departments']) }}</strong>
            <small>Departments represented</small>
        </article>
    </div>

    <section class="staff-directory">
        <div class="staff-directory-heading">
            <div>
                <h2>Staff Directory</h2>
                <p>Employee details, assignments and employment status.</p>
            </div>
            <span class="staff-record-count">
                {{ $staff->total() }} records
            </span>
        </div>

        <form action="{{ route('admin.staff.index') }}" method="GET" class="staff-filters">
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search name, staff number, email..."
                aria-label="Search staff"
            >

            <select name="department" aria-label="Filter by department">
                <option value="">All Departments</option>
                @foreach ($departments as $department)
                    <option value="{{ $department }}"
                        @selected(request('department') === $department)>
                        {{ $department }}
                    </option>
                @endforeach
            </select>

            <select name="status" aria-label="Filter by status">
                <option value="">All Statuses</option>
                <option value="active" @selected(request('status') === 'active')>
                    Active
                </option>
                <option value="inactive" @selected(request('status') === 'inactive')>
                    Inactive
                </option>
            </select>

            <button type="submit" class="staff-filter-button">Apply Filters</button>

            @if (request()->hasAny(['search', 'department', 'status']))
                <a href="{{ route('admin.staff.index') }}" class="staff-reset">Reset</a>
            @endif
        </form>

        <div class="staff-table-wrap">
            <table class="staff-table">
                <thead>
                    <tr>
                        <th>STAFF MEMBER</th>
                        <th>DEPARTMENT & POSITION</th>
                        <th>CONTACT</th>
                        <th>EMPLOYMENT</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($staff as $member)
                        <tr>
                            <td>
                                <div class="staff-identity">
                                    <span class="staff-avatar">
                                        {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                    </span>
                                    <div>
                                        <strong>{{ $member->full_name }}</strong>
                                        <small>{{ $member->staff_number }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <strong class="staff-position">{{ $member->position }}</strong>
                                <small class="staff-subtext">{{ $member->department }}</small>
                            </td>

                            <td>
                                <span class="staff-email">{{ $member->email }}</span>
                                <small class="staff-subtext">
                                    {{ $member->phone ?: 'No phone provided' }}
                                </small>
                            </td>

                            <td>
                                <span class="staff-employment-type">
                                    {{ ucfirst(str_replace('_', ' ', $member->employment_type)) }}
                                </span>
                                <small class="staff-subtext">
                                    Joined
                                    {{ $member->hire_date ? $member->hire_date->format('d M Y') : '—' }}
                                </small>
                            </td>

                            <td>
                                <span class="staff-status {{ $member->status === 'active' ? 'status-active' : 'status-inactive' }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </td>

                            <td>
                                <div class="staff-actions">
                                    <a href="{{ route('admin.staff.show', $member) }}">View</a>

                                    <a href="{{ route('admin.staff.edit', $member) }}">Edit</a>

                                    <form
                                        action="{{ route('admin.staff.status', $member) }}"
                                        method="POST"
                                        onsubmit="return confirm('Change this staff member’s status?')"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit" class="staff-status-action">
                                            {{ $member->status === 'active' ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="staff-empty">
                                    <h3>No staff records found</h3>
                                    <p>
                                        @if (request()->hasAny(['search', 'department', 'status']))
                                            Try changing your search or filters.
                                        @else
                                            Register your first school employee to build the staff directory.
                                        @endif
                                    </p>
                                    @if (request()->hasAny(['search', 'department', 'status']))
                                        <a href="{{ route('admin.staff.index') }}">Clear filters</a>
                                    @else
                                        <a href="{{ route('admin.staff.create') }}">Register staff</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($staff->hasPages())
            <div class="staff-pagination">
                {{ $staff->withQueryString()->links() }}
            </div>
        @endif
    </section>

    <div class="staff-note">
        <strong>Staff records and privacy</strong>
        <p>Employee information should only be accessible to authorised school administrators.</p>
    </div>
</div>
@endsection

@push('styles')
<style>
.staff-page {
    max-width: 1500px;
    margin: 0 auto;
    color: #172b4d;
}
.staff-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 28px;
}
.staff-eyebrow {
    color: #315fbd;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2px;
}
.staff-heading h1 {
    margin: 8px 0;
    color: #17356f;
    font-size: clamp(27px, 4vw, 36px);
    font-weight: 750;
}
.staff-heading p,
.staff-directory-heading p {
    margin: 0;
    color: #6b7890;
    font-size: 12px;
    line-height: 1.7;
}
.staff-primary-button,
.staff-filter-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    min-height: 42px;
    padding: 0 16px;
    border: 0;
    border-radius: 6px;
    background: #214da5;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
}
.staff-primary-button:hover,
.staff-filter-button:hover {
    background: #173777;
}
.staff-primary-button span {
    font-size: 20px;
}
.staff-alert {
    padding: 13px 16px;
    margin-bottom: 18px;
    border-radius: 6px;
    font-size: 13px;
}
.staff-alert-success {
    background: #eaf7ee;
    color: #21643b;
}
.staff-alert-error {
    background: #fff0f0;
    color: #a32d35;
}
.staff-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 25px;
}
.staff-stat-card {
    padding: 21px;
    border: 1px solid #e1e8f3;
    border-radius: 9px;
    background: #fff;
    box-shadow: 0 3px 12px rgba(27, 55, 100, .04);
}
.staff-stat-card > span {
    display: block;
    color: #64738c;
    font-size: 12px;
    font-weight: 650;
}
.staff-stat-card > strong {
    display: block;
    margin: 13px 0 5px;
    color: #214da5;
    font-size: 30px;
    font-weight: 750;
}
.staff-stat-card > small,
.staff-subtext {
    display: block;
    margin-top: 5px;
    color: #7c8aa2;
    font-size: 10px;
}
.staff-directory {
    overflow: hidden;
    border: 1px solid #e1e8f3;
    border-radius: 9px;
    background: #fff;
}
.staff-directory-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 22px 24px;
    border-bottom: 1px solid #e9eef6;
}
.staff-directory-heading h2 {
    margin: 0 0 6px;
    color: #17356f;
    font-size: 21px;
}
.staff-record-count {
    padding: 7px 10px;
    border-radius: 5px;
    background: #edf3ff;
    color: #214da5;
    font-size: 11px;
    font-weight: 700;
}
.staff-filters {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    padding: 17px 24px;
    border-bottom: 1px solid #e9eef6;
}
.staff-filters input,
.staff-filters select {
    box-sizing: border-box;
    min-height: 41px;
    padding: 0 11px;
    border: 1px solid #dce4f0;
    border-radius: 5px;
    background: #fff;
    color: #263b5c;
    font: inherit;
    font-size: 11px;
}
.staff-filters input {
    flex: 1 1 230px;
    min-width: 150px;
}
.staff-filters select {
    max-width: 200px;
}
.staff-reset {
    color: #315fbd;
    font-size: 12px;
    text-decoration: none;
}
.staff-table-wrap {
    width: 100%;
    overflow-x: auto;
}
.staff-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}
.staff-table thead {
    background: #f4f7fc;
}
.staff-table th {
    padding: 14px 16px;
    color: #62718a;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: .6px;
    white-space: nowrap;
}
.staff-table td {
    padding: 16px;
    border-top: 1px solid #edf1f7;
    font-size: 11px;
    vertical-align: middle;
}
.staff-table tbody tr:hover {
    background: #f9fbff;
}
.staff-identity {
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 175px;
}
.staff-avatar {
    display: grid;
    place-items: center;
    flex-shrink: 0;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #e8efff;
    color: #214da5;
    font-size: 12px;
    font-weight: 800;
}
.staff-identity strong,
.staff-position {
    display: block;
    color: #203657;
    font-size: 11px;
    font-weight: 750;
}
.staff-identity small {
    display: block;
    margin-top: 5px;
    color: #7c8aa2;
    font-size: 10px;
}
.staff-email {
    display: block;
    min-width: 145px;
    color: #415574;
    overflow-wrap: anywhere;
}
.staff-employment-type {
    display: inline-block;
    padding: 6px 8px;
    border-radius: 4px;
    background: #edf3ff;
    color: #3157a1;
    font-size: 10px;
    white-space: nowrap;
}
.staff-status {
    display: inline-block;
    padding: 6px 9px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 750;
}
.status-active {
    background: #e7f7ed;
    color: #247044;
}
.status-inactive {
    background: #fff2dd;
    color: #8b6018;
}
.staff-actions {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    min-width: 165px;
}
.staff-actions a,
.staff-actions button {
    padding: 0;
    border: 0;
    background: none;
    color: #2452ac;
    font: inherit;
    font-size: 10px;
    font-weight: 750;
    text-decoration: none;
    cursor: pointer;
}
.staff-actions .staff-status-action {
    color: #8b6018;
}
.staff-empty {
    padding: 45px 20px;
    text-align: center;
}
.staff-empty h3 {
    color: #203c70;
    font-size: 19px;
}
.staff-empty p {
    color: #71809a;
    font-size: 12px;
}
.staff-empty a {
    color: #2452ac;
    font-weight: 700;
}
.staff-pagination {
    padding: 20px 24px;
    border-top: 1px solid #e9eef6;
}
.staff-note {
    margin-top: 20px;
    padding: 17px 19px;
    border: 1px solid #dce6f6;
    border-radius: 7px;
    background: #f3f7ff;
}
.staff-note strong {
    color: #214da5;
    font-size: 12px;
}
.staff-note p {
    margin: 7px 0 0;
    color: #657590;
    font-size: 11px;
    line-height: 1.7;
}
@media (max-width: 1050px) {
    .staff-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}
@media (max-width: 650px) {
    .staff-heading {
        align-items: flex-start;
        flex-direction: column;
    }
    .staff-directory-heading {
        align-items: flex-start;
        flex-direction: column;
        padding: 18px;
    }
    .staff-filters {
        padding: 15px;
    }
    .staff-filters input,
    .staff-filters select,
    .staff-filter-button {
        flex: 1 1 100%;
        max-width: none;
        width: 100%;
    }
    .staff-stat-card {
        padding: 15px;
    }
    .staff-table th,
    .staff-table td {
        padding: 12px;
    }
}
</style>
@endpush
