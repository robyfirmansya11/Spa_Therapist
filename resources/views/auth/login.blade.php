<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Dluwes Hotel Spa</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink:        #1A1410;
            --ink-mid:    #3D3020;
            --ink-soft:   #7A6A54;
            --parchment:  #F8F4EE;
            --parchment2: #F0EAE0;
            --line:       #E2D9CE;
            --gold:       #B8912A;
            --gold-dim:   rgba(184,145,42,0.14);
            --gold-glow:  rgba(184,145,42,0.25);
            --rose:       #A04545;
            --rose-pale:  #F9ECEC;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Jost', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--ink);
        }

        @media (max-width: 760px) {
            body { grid-template-columns: 1fr; }
            .login-panel { display: none; }
        }

        /* ── Left decorative panel ── */
        .login-panel {
            position: relative;
            background: var(--ink);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 3rem;
        }

        /* Layered background texture */
        .panel-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 30% 40%, rgba(184,145,42,0.10) 0%, transparent 70%),
                radial-gradient(ellipse 60% 80% at 70% 80%, rgba(184,145,42,0.06) 0%, transparent 60%);
        }

        /* Decorative grid lines */
        .panel-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(184,145,42,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(184,145,42,0.06) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* Large decorative letter */
        .panel-deco {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -52%);
            font-family: 'Cormorant Garamond', serif;
            font-size: 28vw;
            font-weight: 300;
            font-style: italic;
            color: rgba(184,145,42,0.045);
            user-select: none;
            pointer-events: none;
            line-height: 1;
            white-space: nowrap;
        }

        /* Gold vertical accent */
        .panel-accent {
            position: absolute;
            top: 10%; bottom: 10%;
            right: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, var(--gold), transparent);
            opacity: 0.3;
        }

        .panel-content {
            position: relative;
            z-index: 2;
        }

        .panel-eyebrow {
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.75rem;
            opacity: 0.85;
        }

        .panel-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.2rem;
            font-weight: 300;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1rem;
        }

        .panel-title em {
            font-style: italic;
            color: var(--gold);
        }

        .panel-desc {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.35);
            line-height: 1.7;
            max-width: 320px;
            font-weight: 300;
        }

        .panel-diamonds {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .panel-line { height: 1px; width: 40px; background: linear-gradient(to right, transparent, var(--gold)); opacity: 0.5; }
        .panel-diamond { width: 6px; height: 6px; background: var(--gold); transform: rotate(45deg); opacity: 0.6; flex-shrink: 0; }

        /* ── Right form side ── */
        .login-form-side {
            background: var(--parchment);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
        }

        .login-form-side::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(to right, var(--gold), transparent);
        }

        .form-wrap {
            width: 100%;
            max-width: 380px;
            opacity: 0;
            transform: translateY(16px);
            animation: fadeUp 0.65s 0.15s ease forwards;
        }

        /* Form header */
        .form-eyebrow {
            font-size: 0.65rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 0.4rem;
        }

        .form-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.4rem;
            font-weight: 300;
            color: var(--ink);
            line-height: 1.1;
            margin-bottom: 0.3rem;
        }

        .form-sub {
            font-size: 0.78rem;
            color: var(--ink-soft);
            margin-bottom: 2.2rem;
            font-weight: 300;
        }

        /* Error alert */
        .alert-error {
            background: var(--rose-pale);
            border: 1px solid rgba(160,69,69,0.25);
            border-left: 3px solid var(--rose);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            color: var(--rose);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
        }

        .alert-error svg { flex-shrink: 0; margin-top: 1px; }

        /* Form fields */
        .field-group {
            margin-bottom: 1.25rem;
        }

        .field-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 0.5rem;
        }

        .field-input-wrap {
            position: relative;
        }

        .field-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ink-soft);
            pointer-events: none;
            transition: color 0.2s;
        }

        .field-input {
            width: 100%;
            font-family: 'Jost', sans-serif;
            font-size: 0.9rem;
            color: var(--ink);
            background: #fff;
            border: 1.5px solid var(--line);
            border-radius: 10px;
            padding: 0.7rem 0.9rem 0.7rem 2.5rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-dim);
        }

        .field-input:focus ~ .field-icon,
        .field-input-wrap:focus-within .field-icon {
            color: var(--gold);
        }

        /* Password toggle */
        .field-toggle {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-soft);
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .field-toggle:hover { color: var(--ink); }

        /* Remember me */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.75rem;
        }

        .remember-check {
            width: 16px; height: 16px;
            accent-color: var(--gold);
            cursor: pointer;
            flex-shrink: 0;
        }

        .remember-label {
            font-size: 0.8rem;
            color: var(--ink-soft);
            cursor: pointer;
            user-select: none;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            background: var(--ink);
            color: #fff;
            font-family: 'Jost', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.82rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(184,145,42,0.15));
        }

        .btn-login:hover {
            background: var(--ink-mid);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26,20,16,0.22);
        }

        .btn-login:active { transform: translateY(0); }

        /* Footer */
        .form-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--line);
            text-align: center;
        }

        .form-footer-text {
            font-size: 0.72rem;
            color: var(--ink-soft);
            letter-spacing: 0.04em;
        }

        .form-footer-text span { color: var(--gold); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    {{-- ── Left decorative panel ── --}}
    <div class="login-panel">
        <div class="panel-bg"></div>
        <div class="panel-grid"></div>
        <div class="panel-deco">D</div>
        <div class="panel-accent"></div>

        <div class="panel-content">
            <div class="panel-diamonds">
                <div class="panel-line"></div>
                <div class="panel-diamond"></div>
                <div class="panel-line"></div>
            </div>
            <div class="panel-eyebrow">Wellness &amp; Hospitality</div>
            <div class="panel-title">Dluwes<br><em>Hotel Spa</em></div>
            <p class="panel-desc">
                Platform manajemen terpadu untuk layanan spa dan operasional hotel Dluwes.
            </p>
        </div>
    </div>

    {{-- ── Form side ── --}}
    <div class="login-form-side">
        <div class="form-wrap">

            <div class="form-eyebrow">Selamat Datang</div>
            <h1 class="form-title">Masuk ke<br>Sistem</h1>
            <p class="form-sub">Gunakan akun yang telah diberikan administrator.</p>

            @if(session('error'))
            <div class="alert-error">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                    <circle cx="7.5" cy="7.5" r="6.5" stroke="currentColor" stroke-width="1.4"/>
                    <path d="M7.5 4.5v3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <circle cx="7.5" cy="10.5" r="0.8" fill="currentColor"/>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <rect x="1.5" y="3" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                                <path d="M1.5 5l6 4 6-4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="field-input"
                            placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email">
                    </div>
                </div>

                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-input-wrap">
                        <span class="field-icon">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <rect x="3" y="6.5" width="9" height="7" rx="1.5" stroke="currentColor" stroke-width="1.3"/>
                                <path d="M5 6.5V4.5a2.5 2.5 0 0 1 5 0v2" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                <circle cx="7.5" cy="10" r="1" fill="currentColor"/>
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password">
                        <button type="button" class="field-toggle" id="togglePwd" aria-label="Show password">
                            <svg id="eye-icon" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                <path d="M1 7.5C1 7.5 3.5 3 7.5 3S14 7.5 14 7.5 11.5 12 7.5 12 1 7.5 1 7.5Z" stroke="currentColor" stroke-width="1.3"/>
                                <circle cx="7.5" cy="7.5" r="1.8" stroke="currentColor" stroke-width="1.3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember" class="remember-check">
                    <label for="remember" class="remember-label">Ingat saya di perangkat ini</label>
                </div>

                <button type="submit" class="btn-login">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M5 2H2.5A1.5 1.5 0 0 0 1 3.5v7A1.5 1.5 0 0 0 2.5 12H5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                        <path d="M9.5 10L13 7l-3.5-3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13 7H5.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    </svg>
                    Masuk
                </button>

            </form>

            <div class="form-footer">
                <p class="form-footer-text">&copy; {{ date('Y') }} <span>Dluwes Hotel Spa</span>. All rights reserved.</p>
            </div>

        </div>
    </div>

    <script>
        // Password show/hide toggle
        const toggleBtn = document.getElementById('togglePwd');
        const pwdInput  = document.getElementById('password');

        toggleBtn.addEventListener('click', () => {
            const isHidden = pwdInput.type === 'password';
            pwdInput.type = isHidden ? 'text' : 'password';
            document.getElementById('eye-icon').innerHTML = isHidden
                ? `<path d="M2 2l11 11M6.2 4a5 5 0 0 1 1.3-.2C11.5 3.8 14 7.5 14 7.5s-.8 1.3-2.2 2.5M5 5.5C3 6.7 1 7.5 1 7.5S3.5 12 7.5 12a5.5 5.5 0 0 0 2.8-.8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>`
                : `<path d="M1 7.5C1 7.5 3.5 3 7.5 3S14 7.5 14 7.5 11.5 12 7.5 12 1 7.5 1 7.5Z" stroke="currentColor" stroke-width="1.3"/><circle cx="7.5" cy="7.5" r="1.8" stroke="currentColor" stroke-width="1.3"/>`;
        });
    </script>
</body>
</html>
