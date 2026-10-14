<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#123b78">

    <title>Administrator Login | New Mercies Academy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --blue: #123b78;
            --blue-dark: #0b2852;
            --blue-light: #eaf1fc;
            --gold: #e8ad43;
            --ink: #172b4d;
            --muted: #71819b;
            --paper: #f7f9fd;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--paper);
        }

        .login-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.02fr) minmax(430px, .98fr);
        }

        .login-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            overflow: hidden;
            padding: 38px clamp(28px, 5vw, 70px);
            color: white;
            background:
                linear-gradient(
                    180deg,
                    rgba(8, 30, 66, .42) 0%,
                    rgba(8, 30, 66, .60) 48%,
                    rgba(5, 24, 54, .96) 100%
                ),
                url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1800&q=85')
                center / cover no-repeat,
                var(--blue-dark);
        }

        .login-visual::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(
                135deg,
                rgba(29, 75, 137, .24),
                transparent 55%
            );
        }

        .visual-top,
        .visual-content,
        .visual-bottom {
            position: relative;
            z-index: 1;
        }

        .visual-brand {
            display: flex;
            align-items: center;
            gap: 13px;
            color: white;
            text-decoration: none;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.68);
            border-radius: 12px;
            background: rgba(255,255,255,.08);
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
        }

        .brand-name {
            display: block;
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .brand-tagline {
            display: block;
            margin-top: 4px;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #d9e6fb;
        }

        .visual-content {
            max-width: 540px;
            padding: 60px 0 48px;
        }

        .visual-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #ffd078;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2.4px;
            text-transform: uppercase;
        }

        .visual-eyebrow::before {
            content: "";
            width: 26px;
            height: 2px;
            background: var(--gold);
        }

        .visual-content h1 {
            margin: 0 0 22px;
            font-family: 'Playfair Display', serif;
            font-size: clamp(38px, 4.6vw, 66px);
            font-weight: 500;
            line-height: 1.12;
            letter-spacing: -1.2px;
        }

        .visual-content h1 span {
            color: #ffd078;
        }

        .visual-content p {
            max-width: 440px;
            margin: 0;
            color: rgba(255,255,255,.83);
            font-size: 14px;
            line-height: 1.95;
        }

        .visual-values {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 30px;
        }

        .value-pill {
            padding: 9px 12px;
            border: 1px solid rgba(255,255,255,.24);
            border-radius: 7px;
            background: rgba(255,255,255,.08);
            color: #f4f7ff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .visual-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.20);
            color: rgba(255,255,255,.72);
            font-size: 11px;
            line-height: 1.7;
        }

        .visual-bottom span {
            color: #ffd078;
            font-size: 15px;
        }

        .login-form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
            padding: 42px clamp(25px, 5vw, 76px);
            background: #fff;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
        }

        .mobile-brand {
            display: none;
        }

        .form-eyebrow {
            margin: 0 0 11px;
            color: var(--blue);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .login-heading {
            margin: 0;
            color: var(--blue-dark);
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 3.3vw, 43px);
            font-weight: 600;
            line-height: 1.2;
            letter-spacing: -.7px;
        }

        .login-description {
            margin: 13px 0 30px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.9;
        }

        .form-section-label {
            margin: 0 0 22px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9eef6;
            color: #3d5779;
            font-size: 12px;
            font-weight: 700;
        }

        .login-field {
            margin-bottom: 21px;
        }

        .login-field label {
            display: block;
            margin-bottom: 8px;
            color: #344b6b;
            font-size: 12px;
            font-weight: 750;
        }

        .login-input-wrap {
            position: relative;
        }

        .login-field input {
            display: block;
            width: 100%;
            min-height: 51px;
            padding: 13px 15px;
            border: 1px solid #dce4f0;
            border-radius: 9px;
            outline: none;
            background: #fff;
            color: var(--ink);
            font-family: inherit;
            font-size: 13px;
            transition: border-color .2s, box-shadow .2s;
        }

        .login-field input::placeholder {
            color: #9aa8ba;
        }

        .login-field input:focus {
            border-color: #4776b8;
            box-shadow: 0 0 0 4px rgba(71,118,184,.12);
        }

        .login-field .password-input {
            padding-right: 80px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            border: 0;
            padding: 7px;
            background: transparent;
            color: #42618b;
            font-family: inherit;
            font-size: 11px;
            font-weight: 750;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: var(--blue-dark);
        }

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 2px 0 24px;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #71819b;
            font-size: 12px;
            cursor: pointer;
        }

        .remember-label input {
            width: 16px;
            height: 16px;
            accent-color: var(--blue);
        }

        .login-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 53px;
            padding: 13px 18px;
            border: 1px solid var(--blue);
            border-radius: 9px;
            background: var(--blue);
            color: white;
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .5px;
            cursor: pointer;
            box-shadow: 0 7px 18px rgba(18,59,120,.15);
            transition: background .2s, transform .2s, box-shadow .2s;
        }

        .login-submit:hover {
            background: var(--blue-dark);
            box-shadow: 0 9px 22px rgba(18,59,120,.22);
            transform: translateY(-1px);
        }

        .login-submit:active {
            transform: translateY(0);
        }

        .login-submit span {
            font-size: 17px;
            font-weight: 400;
        }

        .login-error {
            margin-bottom: 20px;
            padding: 14px 15px;
            border: 1px solid #f1caca;
            border-radius: 9px;
            background: #fff3f3;
            color: #9b2929;
            font-size: 12px;
            line-height: 1.8;
        }

        .login-status {
            margin-bottom: 20px;
            padding: 14px 15px;
            border: 1px solid #cde8d7;
            border-radius: 9px;
            background: #f0fbf4;
            color: #176544;
            font-size: 12px;
            line-height: 1.8;
        }

        .security-note {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-top: 24px;
            padding: 15px;
            border: 1px solid #e4ebf5;
            border-radius: 9px;
            background: #f7f9fd;
            color: #71819b;
            font-size: 11px;
            line-height: 1.8;
        }

        .security-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 29px;
            width: 29px;
            height: 29px;
            border-radius: 8px;
            background: #e5edfa;
            color: var(--blue);
            font-size: 15px;
            font-weight: 800;
        }

        .security-note strong {
            display: block;
            margin-bottom: 2px;
            color: #294b7b;
            font-size: 11px;
        }

        .login-footer {
            margin: 30px 0 0;
            color: #98a4b5;
            font-size: 10px;
            line-height: 1.8;
            text-align: center;
        }

        @media (max-width: 900px) {
            .login-layout {
                grid-template-columns: minmax(0, .85fr) minmax(400px, 1.15fr);
            }

            .login-visual {
                padding: 30px;
            }

            .login-form-panel {
                padding: 35px 28px;
            }

            .visual-content h1 {
                font-size: 42px;
            }
        }

        @media (max-width: 720px) {
            .login-layout {
                display: block;
            }

            .login-visual {
                display: none;
            }

            .login-form-panel {
                min-height: 100vh;
                padding: 35px 23px;
                background:
                    radial-gradient(ellipse at top right, #eaf1fc 0, transparent 50%),
                    #fff;
            }

            .login-card {
                max-width: 440px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 48px;
                text-decoration: none;
                color: var(--blue-dark);
            }

            .mobile-brand .brand-mark {
                border-color: #cbd9ee;
                background: var(--blue);
                color: white;
            }

            .mobile-brand .brand-tagline {
                color: #71819b;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition: none !important;
            }
        }
    </style>
</head>

<body>
<main class="login-layout">
    <section class="login-visual" aria-label="New Mercies Academy">
        <div class="visual-top">
            <a href="{{ route('home') }}" class="visual-brand">
                <span class="brand-mark" aria-hidden="true">B</span>
                <span>
                    <span class="brand-name">New Mercies Academy</span>
                    <span class="brand-tagline">Learn · Lead · Succeed</span>
                </span>
            </a>
        </div>

        <div class="visual-content">
            <div class="visual-eyebrow">A foundation for excellence</div>

            <h1>Where young minds <span>flourish.</span></h1>

            <p>
                A dedicated space for the people who make learning possible.
                Manage students, support teachers, and help every learner
                build a brighter future.
            </p>

            <div class="visual-values">
                <span class="value-pill">Academic Excellence</span>
                <span class="value-pill">Character &amp; Leadership</span>
                <span class="value-pill">Lifelong Learning</span>
            </div>
        </div>

        <div class="visual-bottom">
            <span aria-hidden="true">✦</span>
            <div>
                Inspiring curiosity, nurturing character, and building a
                strong foundation for lifelong learning.
            </div>
        </div>
    </section>

    <section class="login-form-panel">
        <div class="login-card">
            <a href="{{ route('home') }}" class="mobile-brand">
                <span class="brand-mark" aria-hidden="true">B</span>
                <span>
                    <span class="brand-name">New Mercies Academy</span>
                    <span class="brand-tagline">Learn · Lead · Succeed</span>
                </span>
            </a>

            <p class="form-eyebrow">School Administration</p>
            <h2 class="login-heading">Welcome back.</h2>

            <p class="login-description">
                Sign in with your authorized account to access the
                New Mercies Academy administration portal.
            </p>

            <p class="form-section-label">Administrator sign-in</p>

            @if ($errors->any())
                <div class="login-error" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="login-status" role="status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="login-field">
                    <label for="email">Email address</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="login-field">
                    <label for="password">Password</label>

                    <div class="login-input-wrap">
                        <input
                            id="password"
                            name="password"
                            class="password-input"
                            type="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="password-toggle"
                            aria-controls="password"
                            aria-pressed="false"
                        >Show</button>
                    </div>
                </div>

                <div class="login-options">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" value="1">
                        Remember me
                    </label>
                </div>

                <button type="submit" class="login-submit">
                    Sign in to New Mercies Academy <span aria-hidden="true">→</span>
                </button>
            </form>

            <div class="security-note">
                <div class="security-icon" aria-hidden="true">✓</div>
                <div>
                    <strong>Secure administration portal</strong>
                    Access is restricted to authorized school accounts.
                    Keep your login credentials private.
                </div>
            </div>

            <p class="login-footer">
                &copy; {{ date('Y') }} New Mercies Academy. All rights reserved.
            </p>
        </div>
    </section>
</main>

<script>
    (function () {
        const password = document.getElementById('password');
        const toggle = document.getElementById('password-toggle');

        if (!password || !toggle) {
            return;
        }

        toggle.addEventListener('click', function () {
            const reveal = password.type === 'password';

            password.type = reveal ? 'text' : 'password';
            toggle.textContent = reveal ? 'Hide' : 'Show';
            toggle.setAttribute('aria-pressed', String(reveal));
        });
    })();
</script>
</body>
</html>
