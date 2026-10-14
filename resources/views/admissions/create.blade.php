@extends('layouts.public')

@section('title', 'Apply for Admission | New Mercies Academy')

@section('content')
<style>
    .admissions-page {
        --adm-blue: #123b78;
        --adm-dark: #0b2852;
        --adm-gold: #d99b32;
        --adm-ink: #1c3150;
        --adm-muted: #71819b;
        --adm-border: #e0e8f3;
        background: #f4f7fc;
        padding: 52px 0 76px;
        color: var(--adm-ink);
    }

    .admissions-page * {
        box-sizing: border-box;
    }

    .admissions-shell {
        width: min(1120px, calc(100% - 40px));
        margin: 0 auto;
    }

    .admissions-hero {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: minmax(0, 1.2fr) minmax(200px, .8fr);
        gap: 25px;
        align-items: center;
        padding: 38px 42px;
        border-radius: 18px;
        background: linear-gradient(120deg, #0b2852, #174b8f);
        color: #fff;
        box-shadow: 0 14px 34px rgba(18,59,120,.14);
    }

    .admissions-hero::before,
    .admissions-hero::after {
        content: "";
        position: absolute;
        pointer-events: none;
        border: 1px solid rgba(255,255,255,.12);
        border-radius: 50%;
    }

    .admissions-hero::before {
        width: 350px;
        height: 350px;
        right: -80px;
        top: -205px;
    }

    .admissions-hero::after {
        width: 270px;
        height: 270px;
        right: 5px;
        bottom: -210px;
    }

    .hero-copy,
    .hero-aside {
        position: relative;
        z-index: 1;
    }

    .admissions-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 16px;
        color: #ffd078;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .admissions-eyebrow::before {
        content: "";
        width: 24px;
        height: 2px;
        background: #ffd078;
    }

    .admissions-hero h1 {
        margin: 0 0 14px;
        color: #fff;
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(31px, 4vw, 45px);
        font-weight: 600;
        line-height: 1.2;
        letter-spacing: -.6px;
    }

    .admissions-hero p {
        max-width: 550px;
        margin: 0;
        color: rgba(255,255,255,.80);
        font-size: 13px;
        line-height: 1.9;
    }

    .hero-aside {
        justify-self: end;
        max-width: 230px;
        padding: 20px;
        border: 1px solid rgba(255,255,255,.20);
        border-radius: 13px;
        background: rgba(255,255,255,.08);
        backdrop-filter: blur(8px);
    }

    .hero-aside-mark {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 39px;
        height: 39px;
        margin-bottom: 15px;
        border-radius: 10px;
        background: #fff;
        color: var(--adm-blue);
        font-family: 'Playfair Display', serif;
        font-size: 23px;
        font-weight: 700;
    }

    .hero-aside strong {
        display: block;
        margin-bottom: 7px;
        color: #fff;
        font-size: 13px;
    }

    .hero-aside span {
        display: block;
        color: rgba(255,255,255,.76);
        font-size: 11px;
        line-height: 1.8;
    }

    .admissions-progress {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 24px 0;
        padding: 17px 21px;
        border: 1px solid var(--adm-border);
        border-radius: 12px;
        background: #fff;
    }

    .progress-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        border-radius: 10px;
        background: #eaf1fc;
        color: var(--adm-blue);
        font-size: 17px;
        font-weight: 800;
    }

    .progress-copy strong {
        display: block;
        margin-bottom: 4px;
        color: #24466f;
        font-size: 12px;
    }

    .progress-copy span {
        color: #7a8ba3;
        font-size: 11px;
        line-height: 1.7;
    }

    .admission-card {
        overflow: hidden;
        border: 1px solid var(--adm-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 8px 28px rgba(20,47,87,.045);
    }

    .admission-card-heading {
        padding: 26px 32px;
        border-bottom: 1px solid #eaf0f7;
        background: linear-gradient(180deg, #fff, #fbfcff);
    }

    .admission-card-heading h2 {
        margin: 0 0 8px;
        color: #183964;
        font-size: 17px;
        font-weight: 800;
    }

    .admission-card-heading p {
        margin: 0;
        color: #7a8ba3;
        font-size: 12px;
        line-height: 1.8;
    }

    .admission-form-body {
        padding: 30px 32px;
    }

    .admission-errors {
        margin: 24px 32px 0;
        padding: 15px 18px;
        border: 1px solid #f1caca;
        border-radius: 10px;
        background: #fff2f2;
        color: #922e2e;
        font-size: 12px;
        line-height: 1.8;
    }

    .admission-errors ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .admission-section {
        margin: 0 0 32px;
    }

    .admission-section:last-child {
        margin-bottom: 0;
    }

    .admission-section-heading {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-bottom: 21px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eaf0f7;
    }

    .section-number {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 36px;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #eaf1fc;
        color: var(--adm-blue);
        font-size: 12px;
        font-weight: 800;
    }

    .admission-section-heading h3 {
        margin: 0 0 5px;
        color: #193d6c;
        font-size: 14px;
        font-weight: 800;
    }

    .admission-section-heading p {
        margin: 0;
        color: #8594a8;
        font-size: 11px;
        line-height: 1.6;
    }

    .admission-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 21px 20px;
    }

    .admission-field {
        min-width: 0;
    }

    .admission-field label {
        display: block;
        margin-bottom: 8px;
        color: #405571;
        font-size: 12px;
        font-weight: 750;
    }

    .required-star {
        color: #bd424b;
    }

    .admission-field input,
    .admission-field select,
    .admission-field textarea {
        display: block;
        width: 100%;
        min-height: 47px;
        padding: 12px 13px;
        border: 1px solid #dce4f0;
        border-radius: 9px;
        background: #fff;
        color: #213a5c;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .admission-field input::placeholder,
    .admission-field textarea::placeholder {
        color: #9aa8ba;
    }

    .admission-field input:focus,
    .admission-field select:focus,
    .admission-field textarea:focus {
        border-color: #4776b8;
        box-shadow: 0 0 0 4px rgba(71,118,184,.11);
    }

    .admission-field textarea {
        min-height: 105px;
        resize: vertical;
    }

    .admission-field .field-help {
        margin-top: 7px;
        color: #8795a9;
        font-size: 11px;
        line-height: 1.6;
    }

    .admission-full {
        grid-column: 1 / -1;
    }

    .admission-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        padding: 23px 32px;
        border-top: 1px solid #eaf0f7;
        background: #fbfcfe;
    }

    .privacy-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        max-width: 390px;
        color: #7b8ba1;
        font-size: 11px;
        line-height: 1.8;
    }

    .privacy-note span {
        color: var(--adm-blue);
        font-size: 15px;
    }

    .admission-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 11px;
        min-height: 48px;
        padding: 13px 21px;
        border: 1px solid var(--adm-blue);
        border-radius: 9px;
        background: var(--adm-blue);
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 5px 14px rgba(18,59,120,.15);
        transition: background .2s, transform .2s, box-shadow .2s;
    }

    .admission-submit:hover {
        background: var(--adm-dark);
        box-shadow: 0 8px 18px rgba(18,59,120,.19);
        transform: translateY(-1px);
    }

    .admission-submit:active {
        transform: translateY(0);
    }

    @media (max-width: 760px) {
        .admissions-page {
            padding: 28px 0 45px;
        }

        .admissions-shell {
            width: calc(100% - 28px);
        }

        .admissions-hero {
            grid-template-columns: 1fr;
            padding: 27px 23px;
            gap: 22px;
        }

        .hero-aside {
            justify-self: start;
            max-width: 100%;
            width: 100%;
        }

        .admissions-hero h1 {
            font-size: 34px;
        }

        .admission-card-heading {
            padding: 22px;
        }

        .admission-form-body {
            padding: 24px 21px;
        }

        .admission-errors {
            margin: 20px 21px 0;
        }

        .admission-form-footer {
            padding: 21px;
            align-items: stretch;
        }

        .privacy-note {
            max-width: none;
        }

        .admission-submit {
            width: 100%;
        }
    }

    @media (max-width: 520px) {
        .admission-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .admission-full {
            grid-column: auto;
        }

        .admissions-progress {
            align-items: flex-start;
            padding: 15px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            transition: none !important;
        }
    }
</style>

<section class="admissions-page">
    <div class="admissions-shell">

        <header class="admissions-hero">
            <div class="hero-copy">
                <div class="admissions-eyebrow">Admissions at New Mercies Academy</div>

                <h1>Every great journey begins with <span style="color:#ffd078;">a first step.</span></h1>

                <p>
                    Begin your child's journey at New Mercies Academy.
                    Tell us a little about your child and family so our
                    admissions team can review the application.
                </p>
            </div>

            <aside class="hero-aside">
                <div class="hero-aside-mark" aria-hidden="true">B</div>
                <strong>Welcome to New Mercies Academy</strong>
                <span>
                    Learn with purpose. Grow with confidence.
                    Build a foundation for lifelong success.
                </span>
            </aside>
        </header>

        <div class="admissions-progress">
            <div class="progress-icon" aria-hidden="true">✓</div>
            <div class="progress-copy">
                <strong>Complete your application</strong>
                <span>
                    Fields marked with * are required. Please check your
                    details before submitting the form.
                </span>
            </div>
        </div>

        <div class="admission-card">
            <div class="admission-card-heading">
                <h2>Admission Application</h2>
                <p>
                    Provide accurate student and parent or guardian information.
                    Your application will be submitted to the school for review.
                </p>
            </div>

            @if ($errors->any())
                <div class="admission-errors" role="alert">
                    <strong>Please correct the following details:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admissions.store') }}">
                @csrf

                <div class="admission-form-body">
                    <section class="admission-section">
                        <div class="admission-section-heading">
                            <span class="section-number">01</span>
                            <div>
                                <h3>Student Information</h3>
                                <p>Tell us about the student applying to New Mercies Academy.</p>
                            </div>
                        </div>

                        <div class="admission-grid">
                            <div class="admission-field">
                                <label for="first_name">First name <span class="required-star">*</span></label>
                                <input
                                    id="first_name"
                                    name="first_name"
                                    value="{{ old('first_name') }}"
                                    maxlength="100"
                                    autocomplete="given-name"
                                    placeholder="Enter first name"
                                    required
                                >
                            </div>

                            <div class="admission-field">
                                <label for="middle_name">Middle name</label>
                                <input
                                    id="middle_name"
                                    name="middle_name"
                                    value="{{ old('middle_name') }}"
                                    maxlength="100"
                                    autocomplete="additional-name"
                                    placeholder="Enter middle name"
                                >
                            </div>

                            <div class="admission-field">
                                <label for="last_name">Last name <span class="required-star">*</span></label>
                                <input
                                    id="last_name"
                                    name="last_name"
                                    value="{{ old('last_name') }}"
                                    maxlength="100"
                                    autocomplete="family-name"
                                    placeholder="Enter last name"
                                    required
                                >
                            </div>

                            <div class="admission-field">
                                <label for="date_of_birth">Date of birth <span class="required-star">*</span></label>
                                <input
                                    type="date"
                                    id="date_of_birth"
                                    name="date_of_birth"
                                    value="{{ old('date_of_birth') }}"
                                    max="{{ now()->subDay()->toDateString() }}"
                                    required
                                >
                            </div>

                            <div class="admission-field">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender">
                                    <option value="">Select gender</option>
                                    <option value="male" @selected(old('gender') === 'male')>Male</option>
                                    <option value="female" @selected(old('gender') === 'female')>Female</option>
                                    <option value="other" @selected(old('gender') === 'other')>Other</option>
                                </select>
                            </div>

                            <div class="admission-field">
                                <label for="class_applying_for">Class applying for <span class="required-star">*</span></label>
                                <select id="class_applying_for" name="class_applying_for" required>
                                    <option value="">Select class</option>
                                    @foreach ([
                                        'Primary 1', 'Primary 2', 'Primary 3',
                                        'Primary 4', 'Primary 5', 'Primary 6',
                                        'JSS 1', 'JSS 2', 'JSS 3',
                                        'SS 1', 'SS 2', 'SS 3'
                                    ] as $class)
                                        <option
                                            value="{{ $class }}"
                                            @selected(old('class_applying_for') === $class)
                                        >
                                            {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="admission-field admission-full">
                                <label for="previous_school">Previous school</label>
                                <input
                                    id="previous_school"
                                    name="previous_school"
                                    value="{{ old('previous_school') }}"
                                    maxlength="200"
                                    placeholder="Enter previous school, if applicable"
                                >
                            </div>
                        </div>
                    </section>

                    <section class="admission-section">
                        <div class="admission-section-heading">
                            <span class="section-number">02</span>
                            <div>
                                <h3>Parent or Guardian</h3>
                                <p>Provide the contact information for the responsible adult.</p>
                            </div>
                        </div>

                        <div class="admission-grid">
                            <div class="admission-field">
                                <label for="guardian_name">Full name <span class="required-star">*</span></label>
                                <input
                                    id="guardian_name"
                                    name="guardian_name"
                                    value="{{ old('guardian_name') }}"
                                    maxlength="150"
                                    autocomplete="name"
                                    placeholder="Parent or guardian's full name"
                                    required
                                >
                            </div>

                            <div class="admission-field">
                                <label for="guardian_relationship">Relationship to student</label>
                                <input
                                    id="guardian_relationship"
                                    name="guardian_relationship"
                                    value="{{ old('guardian_relationship') }}"
                                    maxlength="100"
                                    placeholder="e.g. Parent or guardian"
                                >
                            </div>

                            <div class="admission-field">
                                <label for="guardian_email">Email address <span class="required-star">*</span></label>
                                <input
                                    type="email"
                                    id="guardian_email"
                                    name="guardian_email"
                                    value="{{ old('guardian_email') }}"
                                    maxlength="255"
                                    autocomplete="email"
                                    placeholder="name@example.com"
                                    required
                                >
                            </div>

                            <div class="admission-field">
                                <label for="guardian_phone">Telephone number <span class="required-star">*</span></label>
                                <input
                                    type="tel"
                                    id="guardian_phone"
                                    name="guardian_phone"
                                    value="{{ old('guardian_phone') }}"
                                    maxlength="30"
                                    autocomplete="tel"
                                    placeholder="Enter telephone number"
                                    required
                                >
                            </div>

                            <div class="admission-field admission-full">
                                <label for="address">Home address</label>
                                <textarea
                                    id="address"
                                    name="address"
                                    maxlength="2000"
                                    autocomplete="street-address"
                                    placeholder="Enter the student's home address"
                                >{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="admission-form-footer">
                    <div class="privacy-note">
                        <span aria-hidden="true">◆</span>
                        <div>
                            Please check your information before submitting.
                            Your application will be processed by the school
                            through its existing admissions system.
                        </div>
                    </div>

                    <button type="submit" class="admission-submit">
                        Submit Application <span aria-hidden="true">→</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
