@extends('layouts.public')

@section('title', 'New Mercies Academy | Learn, Lead, Succeed')
@section('description', 'Discover New Mercies Academy, a welcoming primary and secondary school committed to academic excellence, character development and lifelong learning.')

@section('content')
<style>
    .bh-home {
        --bh-blue: #123b78;
        --bh-blue-dark: #102f61;
        --bh-gold: #f2bd50;
        --bh-text: #34435a;
        --bh-muted: #68758a;
        --bh-pale: #f5f8fd;
        color: var(--bh-text);
    }
    .bh-home * { box-sizing: border-box; }
    .bh-home .bh-shell { width: min(1160px, calc(100% - 40px)); margin-inline: auto; }
    .bh-home a { text-decoration: none; }
    .bh-home .bh-eyebrow {
        display: inline-block; color: #a17116; font-size: 11px; font-weight: 800;
        letter-spacing: 2px; text-transform: uppercase;
    }
    .bh-home .bh-button {
        display: inline-flex; align-items: center; justify-content: center; gap: 9px;
        min-height: 48px; padding: 13px 21px; border: 1px solid var(--bh-blue);
        border-radius: 6px; background: var(--bh-blue); color: #fff;
        font-size: 13px; font-weight: 750; line-height: 1.35;
        transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
    }
    .bh-home .bh-button:hover { background: #0a2650; color: #fff; transform: translateY(-2px); box-shadow: 0 8px 20px #071e4320; }
    .bh-home .bh-button-gold { border-color: var(--bh-gold); background: var(--bh-gold); color: #10294d; }
    .bh-home .bh-button-gold:hover { border-color: #ffd477; background: #ffd477; color: #10294d; }
    .bh-home .bh-button-outline { border-color: rgba(255,255,255,.7); background: transparent; color: #fff; }
    .bh-home .bh-button-outline:hover { background: #fff; color: var(--bh-blue); }
    .bh-home .bh-hero {
        display: flex; align-items: center; min-height: 610px; padding: 80px 0; overflow: hidden;
        background: linear-gradient(90deg, rgba(7,30,67,.94) 0%, rgba(13,49,99,.83) 52%, rgba(13,49,99,.22) 100%),
        url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=2000&q=85') center 45% / cover no-repeat;
        color: #fff;
    }
    .bh-home .bh-hero-content { max-width: 700px; }
    .bh-home .bh-hero .bh-eyebrow { color: var(--bh-gold); }
    .bh-home .bh-hero h1 {
        margin: 20px 0; color: #fff; font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(42px, 6vw, 74px); line-height: 1.12; font-weight: 700;
    }
    .bh-home .bh-hero p { max-width: 590px; margin: 0 0 28px; color: #e3ebf7; font-size: 15px; line-height: 1.9; }
    .bh-home .bh-hero-actions { display: flex; flex-wrap: wrap; gap: 12px; }
    .bh-home .bh-section { padding: 82px 0; }
    .bh-home .bh-section-light { background: var(--bh-pale); }
    .bh-home .bh-section-heading { max-width: 700px; margin: 0 auto 42px; text-align: center; }
    .bh-home .bh-section-heading h2,
    .bh-home .bh-about-content h2 {
        margin: 12px 0; color: var(--bh-blue); font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(30px, 4vw, 43px); line-height: 1.2;
    }
    .bh-home .bh-section-heading p,
    .bh-home .bh-about-content > p { color: var(--bh-muted); font-size: 14px; line-height: 1.9; }
    .bh-home .bh-about-grid { display: grid; grid-template-columns: 1fr 1fr; align-items: center; gap: 60px; }
    .bh-home .bh-about-image { position: relative; }
    .bh-home .bh-about-image img { display: block; width: 100%; height: 440px; border-radius: 12px; object-fit: cover; }
    .bh-home .bh-image-note {
        position: absolute; right: -12px; bottom: 22px; max-width: 250px; padding: 19px 23px;
        border-radius: 8px; background: var(--bh-blue); color: #fff;
        box-shadow: 0 12px 30px rgba(10,38,80,.18); font-size: 13px; font-weight: 650;
    }
    .bh-home .bh-check-list { display: grid; gap: 13px; margin: 23px 0 28px; padding: 0; list-style: none; }
    .bh-home .bh-check-list li { display: flex; align-items: flex-start; gap: 12px; color: var(--bh-text); font-size: 13px; line-height: 1.7; }
    .bh-home .bh-check { display: inline-grid; flex: 0 0 24px; width: 24px; height: 24px; place-items: center; border-radius: 50%; background: #e7effc; color: var(--bh-blue); font-weight: 800; }
    .bh-home .bh-card-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 23px; }
    .bh-home .bh-card { overflow: hidden; border: 1px solid #e3e9f2; border-radius: 10px; background: #fff; transition: transform .2s ease, box-shadow .2s ease; }
    .bh-home .bh-card:hover { transform: translateY(-4px); box-shadow: 0 14px 35px rgba(18,59,120,.09); }
    .bh-home .bh-card > img { display: block; width: 100%; height: 220px; object-fit: cover; }
    .bh-home .bh-card-body { padding: 24px; }
    .bh-home .bh-card-body h3 { margin: 0 0 10px; color: var(--bh-blue); font-family: 'Playfair Display', Georgia, serif; font-size: 23px; }
    .bh-home .bh-card-body p { margin: 0 0 18px; color: var(--bh-muted); font-size: 13px; line-height: 1.85; }
    .bh-home .bh-card-link { display: inline-block; color: var(--bh-blue); font-size: 12px; font-weight: 800; }
    .bh-home .bh-card-link:hover { color: #3478c8; text-decoration: underline; }
    .bh-home .bh-academic-card { padding: 27px 23px; }
    .bh-home .bh-academic-icon { display: grid; width: 49px; height: 49px; margin-bottom: 20px; place-items: center; border-radius: 10px; background: #eaf1fc; color: var(--bh-blue); font-size: 23px; }
    .bh-home .bh-academic-card h3 { margin: 0 0 10px; color: var(--bh-blue); font-size: 16px; }
    .bh-home .bh-academic-card p { margin: 0; color: var(--bh-muted); font-size: 13px; line-height: 1.8; }
    .bh-home .bh-admissions { background: var(--bh-blue-dark); color: #fff; }
    .bh-home .bh-admissions-grid { display: grid; grid-template-columns: 1fr .9fr; align-items: center; gap: 55px; }
    .bh-home .bh-admissions .bh-eyebrow { color: var(--bh-gold); }
    .bh-home .bh-admissions h2 { margin: 13px 0; color: #fff; font-family: 'Playfair Display', Georgia, serif; font-size: clamp(32px, 4vw, 46px); line-height: 1.2; }
    .bh-home .bh-admissions p { color: #d6e1f1; font-size: 14px; line-height: 1.9; }
    .bh-home .bh-steps { display: grid; gap: 17px; margin: 27px 0; }
    .bh-home .bh-step { display: flex; align-items: flex-start; gap: 15px; }
    .bh-home .bh-step-number { display: grid; flex: 0 0 35px; width: 35px; height: 35px; place-items: center; border-radius: 50%; background: var(--bh-gold); color: var(--bh-blue-dark); font-weight: 800; }
    .bh-home .bh-step strong { display: block; color: #fff; font-size: 14px; }
    .bh-home .bh-step span { display: block; margin-top: 4px; color: #d6e1f1; font-size: 12px; line-height: 1.7; }
    .bh-home .bh-admissions-image img { display: block; width: 100%; min-height: 380px; border-radius: 12px; object-fit: cover; }
    .bh-home .bh-news-date { display: block; margin-bottom: 10px; color: #a17116; font-size: 10px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
    .bh-home .bh-contact-panel { display: grid; grid-template-columns: 1fr 1fr; gap: 35px; padding: 36px; border: 1px solid #e3e9f2; border-radius: 12px; background: #fff; }
    .bh-home .bh-contact-panel h3 { margin: 0 0 12px; color: var(--bh-blue); font-family: 'Playfair Display', Georgia, serif; font-size: 25px; }
    .bh-home .bh-contact-panel p { color: var(--bh-muted); font-size: 13px; line-height: 1.9; }
    .bh-home .bh-contact-item { margin: 17px 0; font-size: 13px; overflow-wrap: anywhere; }
    .bh-home .bh-contact-item strong { display: block; margin-bottom: 4px; color: var(--bh-blue); }
    .bh-home .bh-contact-note { padding: 22px; border-radius: 8px; background: #f0f5fd; }
    .bh-home .bh-contact-note p { margin-bottom: 0; }
    .bh-home .bh-final-cta { padding: 55px 0; background: #eaf1fc; text-align: center; }
    .bh-home .bh-final-cta h2 { margin: 12px 0; color: var(--bh-blue); font-family: 'Playfair Display', Georgia, serif; font-size: clamp(28px, 4vw, 40px); }
    .bh-home .bh-final-cta p { max-width: 620px; margin: 0 auto 24px; color: var(--bh-muted); font-size: 14px; line-height: 1.9; }
    .bh-home a:focus-visible { outline: 3px solid #f2bd50; outline-offset: 3px; }
    @media (max-width: 850px) {
        .bh-home .bh-about-grid, .bh-home .bh-admissions-grid { grid-template-columns: 1fr; gap: 35px; }
        .bh-home .bh-card-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .bh-home .bh-image-note { right: 10px; }
    }
    @media (max-width: 560px) {
        .bh-home .bh-shell { width: min(100% - 30px, 1160px); }
        .bh-home .bh-hero { min-height: 560px; padding: 65px 0 80px; background-position: 60% center; }
        .bh-home .bh-hero p { font-size: 14px; }
        .bh-home .bh-hero-actions { align-items: stretch; flex-direction: column; }
        .bh-home .bh-hero-actions .bh-button { width: 100%; }
        .bh-home .bh-section { padding: 62px 0; }
        .bh-home .bh-card-grid, .bh-home .bh-contact-panel { grid-template-columns: 1fr; }
        .bh-home .bh-about-image img { height: 330px; }
        .bh-home .bh-image-note { right: 8px; bottom: 10px; max-width: 205px; padding: 14px; }
        .bh-home .bh-admissions-image img { min-height: 280px; }
        .bh-home .bh-contact-panel { padding: 23px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .bh-home *, .bh-home *::before, .bh-home *::after { scroll-behavior: auto !important; transition: none !important; }
    }
</style>

<div class="bh-home">
    {{-- HERO --}}
    <section class="bh-hero" aria-labelledby="bh-home-title">
        <div class="bh-shell">
            <div class="bh-hero-content">
                <span class="bh-eyebrow">Welcome to New Mercies Academy</span>
                <h1 id="bh-home-title">Building Bright Minds. Shaping Tomorrow's Leaders.</h1>
                <p>We nurture curious minds, develop confident learners and inspire every student to discover their potential in a supportive and engaging school environment.</p>
                <div class="bh-hero-actions">
                    <a href="{{ route('admissions.create') }}" class="bh-button bh-button-gold">Apply for Admission <span aria-hidden="true">→</span></a>
                    <a href="#about" class="bh-button bh-button-outline">Discover Our School</a>
                </div>
            </div>
        </div>
    </section>

    {{-- INTRODUCTION --}}
    <section class="bh-section" id="about">
        <div class="bh-shell bh-about-grid">
            <div class="bh-about-image">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1100&q=85" alt="Students learning together in a classroom" loading="lazy">
                <div class="bh-image-note">Inspiring learning. Building confidence. Creating possibilities.</div>
            </div>
            <div class="bh-about-content">
                <span class="bh-eyebrow">Who We Are</span>
                <h2>A School Where Every Student Can Thrive</h2>
                <p>New Mercies Academy is designed to support learners at every stage of their educational journey. Our approach combines academic development, personal responsibility and practical learning experiences.</p>
                <p>We aim to create an environment where students feel supported to ask questions, explore ideas, develop their talents and work towards meaningful goals.</p>
                <ul class="bh-check-list">
                    <li><span class="bh-check" aria-hidden="true">✓</span><span>Student-centred teaching and learning.</span></li>
                    <li><span class="bh-check" aria-hidden="true">✓</span><span>Emphasis on character, discipline and respect.</span></li>
                    <li><span class="bh-check" aria-hidden="true">✓</span><span>Encouragement of creativity, teamwork and critical thinking.</span></li>
                    <li><span class="bh-check" aria-hidden="true">✓</span><span>A supportive partnership between school and family.</span></li>
                </ul>
                <a href="#schools" class="bh-button">Explore Our Schools <span aria-hidden="true">→</span></a>
            </div>
        </div>
    </section>

    {{-- SCHOOL LEVELS --}}
    <section class="bh-section bh-section-light" id="schools">
        <div class="bh-shell">
            <div class="bh-section-heading">
                <span class="bh-eyebrow">Our Learning Community</span>
                <h2>Education for Every Stage</h2>
                <p>We provide a learning journey that supports students as they develop foundational knowledge, independent thinking and readiness for future opportunities.</p>
            </div>
            <div class="bh-card-grid">
                <article class="bh-card">
                    <img src="https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?auto=format&fit=crop&w=900&q=85" alt="Young learners participating in a classroom activity" loading="lazy">
                    <div class="bh-card-body">
                        <h3>Primary School</h3>
                        <p>Building strong foundations in literacy, numeracy, communication, curiosity and positive learning habits.</p>
                        <a href="{{ route('admissions.create') }}" class="bh-card-link">Apply for Primary School <span aria-hidden="true">→</span></a>
                    </div>
                </article>
                <article class="bh-card">
                    <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&w=900&q=85" alt="Students collaborating on schoolwork" loading="lazy">
                    <div class="bh-card-body">
                        <h3>Secondary School</h3>
                        <p>Developing deeper subject knowledge, analytical skills, independence and preparation for future study.</p>
                        <a href="{{ route('admissions.create') }}" class="bh-card-link">Apply for Secondary School <span aria-hidden="true">→</span></a>
                    </div>
                </article>
                <article class="bh-card">
                    <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?auto=format&fit=crop&w=900&q=85" alt="Students taking part in a group learning activity" loading="lazy">
                    <div class="bh-card-body">
                        <h3>Student Development</h3>
                        <p>Encouraging leadership, collaboration, creativity, responsibility and participation beyond the classroom.</p>
                        <a href="#academics" class="bh-card-link">Discover Student Development <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- ACADEMICS --}}
    <section class="bh-section" id="academics">
        <div class="bh-shell">
            <div class="bh-section-heading">
                <span class="bh-eyebrow">Learning and Growth</span>
                <h2>More Than Classroom Learning</h2>
                <p>We believe that a well-rounded education encourages students to think independently, solve problems and work effectively with others.</p>
            </div>
            <div class="bh-card-grid">
                <article class="bh-card bh-academic-card"><div class="bh-academic-icon" aria-hidden="true">📚</div><h3>Academic Excellence</h3><p>Encouraging understanding, consistent effort and strong learning habits across subject areas.</p></article>
                <article class="bh-card bh-academic-card"><div class="bh-academic-icon" aria-hidden="true">🔬</div><h3>Science and Discovery</h3><p>Inspiring students to ask questions, explore concepts and develop practical problem-solving skills.</p></article>
                <article class="bh-card bh-academic-card"><div class="bh-academic-icon" aria-hidden="true">💻</div><h3>Digital Skills</h3><p>Promoting responsible technology use and the digital literacy needed in a changing world.</p></article>
                <article class="bh-card bh-academic-card"><div class="bh-academic-icon" aria-hidden="true">🎨</div><h3>Creative Expression</h3><p>Making room for imagination, artistic expression and new ways of communicating ideas.</p></article>
                <article class="bh-card bh-academic-card"><div class="bh-academic-icon" aria-hidden="true">⚽</div><h3>Sports and Teamwork</h3><p>Supporting cooperation, healthy participation, perseverance and respect for others.</p></article>
                <article class="bh-card bh-academic-card"><div class="bh-academic-icon" aria-hidden="true">🌱</div><h3>Character Development</h3><p>Encouraging honesty, kindness, discipline, responsibility and positive leadership.</p></article>
            </div>
        </div>
    </section>

    {{-- ADMISSIONS --}}
    <section class="bh-section bh-admissions" id="admissions">
        <div class="bh-shell bh-admissions-grid">
            <div>
                <span class="bh-eyebrow">Your Journey Starts Here</span>
                <h2>Give Your Child a Strong Foundation for the Future</h2>
                <p>Take the first step towards joining the New Mercies Academy learning community. Submit an application online and keep the reference number shown after submission for your records.</p>
                <div class="bh-steps">
                    <div class="bh-step"><div class="bh-step-number">1</div><div><strong>Complete the Application</strong><span>Enter the applicant's details and a parent or guardian's contact information.</span></div></div>
                    <div class="bh-step"><div class="bh-step-number">2</div><div><strong>Keep Your Reference</strong><span>Save the application reference displayed after you submit the form.</span></div></div>
                    <div class="bh-step"><div class="bh-step-number">3</div><div><strong>Wait for School Review</strong><span>The school can review the submitted application and update its status.</span></div></div>
                </div>
                <a href="{{ route('admissions.create') }}" class="bh-button bh-button-gold">Start an Application <span aria-hidden="true">→</span></a>
            </div>
            <div class="bh-admissions-image">
                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=1000&q=85" alt="Teacher helping students during a lesson" loading="lazy">
            </div>
        </div>
    </section>

    {{-- NEWS AND EVENTS: static introductory content until the admin news module is connected --}}
    <section class="bh-section bh-section-light" id="news">
        <div class="bh-shell">
            <div class="bh-section-heading">
                <span class="bh-eyebrow">School Community</span>
                <h2>News, Activities and Events</h2>
                <p>School activities provide opportunities for students to participate, build friendships and celebrate learning.</p>
            </div>
            <div class="bh-card-grid">
                <article class="bh-card">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=900&q=85" alt="Students learning in a classroom" loading="lazy">
                    <div class="bh-card-body"><span class="bh-news-date">Learning</span><h3>Learning Through Curiosity</h3><p>Classroom discussions and practical activities can help learners explore new ideas.</p><a href="#school-contact" class="bh-card-link">Contact the School <span aria-hidden="true">→</span></a></div>
                </article>
                <article class="bh-card">
                    <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?auto=format&fit=crop&w=900&q=85" alt="Students participating in a group activity" loading="lazy">
                    <div class="bh-card-body"><span class="bh-news-date">Student Life</span><h3>Growing Together</h3><p>Team activities encourage communication, collaboration and respect for different perspectives.</p><a href="#school-contact" class="bh-card-link">Contact the School <span aria-hidden="true">→</span></a></div>
                </article>
                <article class="bh-card">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=900&q=85" alt="Educational environment for young learners" loading="lazy">
                    <div class="bh-card-body"><span class="bh-news-date">Admissions</span><h3>Begin Your School Journey</h3><p>Families can submit an online application to begin the admissions process.</p><a href="{{ route('admissions.create') }}" class="bh-card-link">Apply for Admission <span aria-hidden="true">→</span></a></div>
                </article>
            </div>
        </div>
    </section>

    {{-- CONTACT: replace the displayed placeholders when official details are known --}}
    <section class="bh-section" id="school-contact">
        <div class="bh-shell">
            <div class="bh-section-heading">
                <span class="bh-eyebrow">We Are Here to Help</span>
                <h2>Connect With New Mercies Academy</h2>
                <p>Parents and guardians can use the school's official contact channels to ask questions about classes, admissions and school life.</p>
            </div>
            <div class="bh-contact-panel">
                <div>
                    <h3>Let's Start a Conversation</h3>
                    <p>We welcome enquiries from families seeking information about our primary and secondary school programmes.</p>
                    <div class="bh-contact-item"><strong>School Address</strong><span>School address to be configured.</span></div>
                    <div class="bh-contact-item"><strong>Email Address</strong><span>School email to be configured.</span></div>
                    <div class="bh-contact-item"><strong>Telephone</strong><span>School telephone number to be configured.</span></div>
                </div>
                <div class="bh-contact-note">
                    <h3>Interested in Admission?</h3>
                    <p>Start an application online. The school can review submitted details through the administration area.</p>
                    <a href="{{ route('admissions.create') }}" class="bh-button" style="margin-top:14px">Apply for Admission <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </section>

    {{-- FINAL CALL TO ACTION --}}
    <section class="bh-final-cta">
        <div class="bh-shell">
            <span class="bh-eyebrow">New Mercies Academy</span>
            <h2>Learn Today. Lead Tomorrow.</h2>
            <p>Education is a journey of discovery, growth and opportunity. We look forward to helping families learn more about our school.</p>
            <a href="{{ route('admissions.create') }}" class="bh-button">Apply for Admission <span aria-hidden="true">→</span></a>
        </div>
    </section>
</div>
@endsection
