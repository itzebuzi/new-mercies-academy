<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'New Mercies Academy | Learn, Lead, Succeed')</title>

    <meta name="description"
          content="@yield('description', 'New Mercies Academy provides a supportive learning environment for primary and secondary school students.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --school-blue: #123b78;
            --school-blue-dark: #0a2650;
            --school-blue-light: #eaf1fc;
            --school-gold: #f2bd50;
            --school-white: #ffffff;
            --school-background: #f7f9fd;
            --school-text: #17243a;
            --school-muted: #68758a;
            --school-border: #e2e8f1;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 95px;
        }

        body {
            margin: 0;
            background: var(--school-white);
            color: var(--school-text);
            font-family: 'DM Sans', Arial, sans-serif;
            line-height: 1.6;
        }

        body, button, input, select, textarea {
            font-family: 'DM Sans', Arial, sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
        }

        button {
            font: inherit;
        }

        .school-shell {
            width: min(1160px, calc(100% - 40px));
            margin-inline: auto;
        }

        .school-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, .97);
            border-bottom: 1px solid var(--school-border);
            backdrop-filter: blur(12px);
        }

        .school-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 82px;
            gap: 25px;
        }

        .school-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .school-brand-mark {
            display: grid;
            place-items: center;
            width: 47px;
            height: 47px;
            border-radius: 12px;
            background: var(--school-blue);
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            font-weight: 700;
        }

        .school-brand-name {
            display: block;
            color: var(--school-blue);
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.2;
        }

        .school-brand-subtitle {
            display: block;
            margin-top: 5px;
            color: var(--school-muted);
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.7px;
            text-transform: uppercase;
        }

        .school-nav {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 22px;
            font-size: 12px;
            font-weight: 600;
        }

        .school-nav a {
            transition: color .2s ease;
        }

        .school-nav a:hover,
        .school-nav a:focus-visible {
            color: #3274c8;
        }

        .school-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 47px;
            padding: 12px 20px;
            border: 1px solid var(--school-blue);
            border-radius: 7px;
            background: var(--school-blue);
            color: white;
            font-size: 12px;
            font-weight: 700;
            text-align: center;
            transition: background .2s ease, transform .2s ease;
            cursor: pointer;
        }

        .school-button:hover {
            background: var(--school-blue-dark);
            color: white;
            transform: translateY(-1px);
        }

        .school-button-outline {
            border-color: rgba(255, 255, 255, .75);
            background: transparent;
            color: white;
        }

        .school-button-outline:hover {
            background: white;
            color: var(--school-blue);
        }

        .school-menu-toggle {
            display: none;
            width: 43px;
            height: 43px;
            border: 1px solid var(--school-border);
            border-radius: 7px;
            background: white;
            color: var(--school-blue);
            font-size: 23px;
            cursor: pointer;
        }

        .school-mobile-nav {
            display: none;
            padding: 0 0 18px;
        }

        .school-mobile-nav.is-open {
            display: grid;
        }

        .school-mobile-nav a {
            padding: 12px 4px;
            border-top: 1px solid var(--school-border);
            color: var(--school-text);
            font-size: 14px;
            font-weight: 600;
        }

        .school-footer {
            padding: 58px 0 22px;
            background: var(--school-blue-dark);
            color: white;
        }

        .school-footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
            gap: 35px;
        }

        .school-footer .school-brand-name {
            color: white;
        }

        .school-footer .school-brand-subtitle {
            color: #c8d5ea;
        }

        .school-footer-copy {
            margin-top: 38px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.16);
            color: #c8d5ea;
            font-size: 11px;
        }

        .school-footer-heading {
            margin: 0 0 17px;
            color: var(--school-gold);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .school-footer-links {
            display: grid;
            gap: 10px;
            font-size: 13px;
        }

        .school-footer-links a {
            color: #e0e8f5;
        }

        .school-footer-links a:hover {
            color: var(--school-gold);
        }

        .school-flash {
            margin: 18px auto;
            padding: 14px 17px;
            border: 1px solid #b8dfc4;
            border-radius: 7px;
            background: #edf9f0;
            color: #205e32;
            font-size: 13px;
        }

        .school-errors {
            margin: 18px auto;
            padding: 14px 17px;
            border: 1px solid #f0caca;
            border-radius: 7px;
            background: #fff2f2;
            color: #922e2e;
            font-size: 13px;
        }

        @media (max-width: 1000px) {
            .school-nav {
                gap: 13px;
                font-size: 11px;
            }

            .school-header-inner {
                gap: 14px;
            }

            .school-brand-name {
                font-size: 17px;
            }

            .school-nav-cta {
                padding-inline: 12px;
            }

            .school-footer-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .school-shell {
                width: min(100% - 32px, 1160px);
            }

            .school-header-inner {
                min-height: 73px;
            }

            .school-nav,
            .school-nav-cta {
                display: none;
            }

            .school-menu-toggle {
                display: inline-grid;
                place-items: center;
            }

            .school-footer-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 30px 22px;
            }
        }

        @media (max-width: 430px) {
            .school-brand-mark {
                width: 40px;
                height: 40px;
                font-size: 23px;
            }

            .school-brand-name {
                font-size: 16px;
            }

            .school-brand-subtitle {
                font-size: 8px;
                letter-spacing: 1px;
            }

            .school-footer-grid {
                grid-template-columns: 1fr;
            }
        }

        @stack('styles')
    </style>
</head>

<body>
    <header class="school-header">
        <div class="school-shell school-header-inner">
            <a href="{{ route('home') }}" class="school-brand" aria-label="New Mercies Academy homepage">
                <span class="school-brand-mark">B</span>
                <span>
                    <span class="school-brand-name">New Mercies Academy</span>
                    <span class="school-brand-subtitle">Learn · Lead · Succeed</span>
                </span>
            </a>

            <nav class="school-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#about">About</a>
                <a href="{{ route('home') }}#schools">Our Schools</a>
                <a href="{{ route('home') }}#academics">Academics</a>
                <a href="{{ route('home') }}#admissions">Admissions</a>
                <a href="{{ route('home') }}#contact">Contact</a>
            </nav>

            <a href="{{ route('home') }}#admissions" class="school-button school-nav-cta">
                Apply for Admission <span aria-hidden="true">→</span>
            </a>

            <button
                class="school-menu-toggle"
                id="schoolMenuToggle"
                type="button"
                aria-label="Toggle navigation"
                aria-expanded="false"
                aria-controls="schoolMobileNav">
                ☰
            </button>
        </div>

        <nav class="school-shell school-mobile-nav" id="schoolMobileNav" aria-label="Mobile navigation">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#about">About Us</a>
            <a href="{{ route('home') }}#schools">Primary &amp; Secondary</a>
            <a href="{{ route('home') }}#academics">Academics</a>
            <a href="{{ route('home') }}#admissions">Admissions</a>
            <a href="{{ route('home') }}#news">News &amp; Events</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </nav>
    </header>

    @if (session('success'))
        <div class="school-shell school-flash" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="school-shell school-errors" role="alert">
            <strong>Please review the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="school-footer" id="contact">
        <div class="school-shell">
            <div class="school-footer-grid">
                <div>
                    <a href="{{ route('home') }}" class="school-brand">
                        <span class="school-brand-mark">B</span>
                        <span>
                            <span class="school-brand-name">New Mercies Academy</span>
                            <span class="school-brand-subtitle">Learn · Lead · Succeed</span>
                        </span>
                    </a>

                    <p style="max-width:300px;margin-top:20px;color:#d7e2f2;font-size:13px;line-height:1.9">
                        Inspiring curiosity, nurturing character and building a strong foundation for lifelong learning.
                    </p>
                </div>

                <div>
                    <h2 class="school-footer-heading">Explore</h2>
                    <div class="school-footer-links">
                        <a href="{{ route('home') }}#about">About Us</a>
                        <a href="{{ route('home') }}#schools">Our Schools</a>
                        <a href="{{ route('home') }}#academics">Academics</a>
                        <a href="{{ route('home') }}#news">News &amp; Events</a>
                    </div>
                </div>

                <div>
                    <h2 class="school-footer-heading">Admissions</h2>
                    <div class="school-footer-links">
                        <a href="{{ route('home') }}#admissions">Apply for Admission</a>
                        <a href="{{ route('home') }}#schools">Primary School</a>
                        <a href="{{ route('home') }}#schools">Secondary School</a>
                    </div>
                </div>

                <div>
                    <h2 class="school-footer-heading">Contact</h2>
                    <div class="school-footer-links">
                        <a href="{{ route('home') }}#contact">Contact the School</a>
                        <span style="color:#d7e2f2">Email and telephone details to be configured.</span>
                    </div>
                </div>
            </div>

            <div class="school-footer-copy">
                &copy; {{ date('Y') }} New Mercies Academy. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        (() => {
            const toggle = document.getElementById('schoolMenuToggle');
            const menu = document.getElementById('schoolMobileNav');

            if (!toggle || !menu) return;

            toggle.addEventListener('click', () => {
                const isOpen = menu.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', String(isOpen));
                toggle.textContent = isOpen ? '×' : '☰';
            });

            menu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                    toggle.textContent = '☰';
                });
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
