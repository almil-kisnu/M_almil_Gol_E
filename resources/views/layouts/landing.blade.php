<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Joni Motor - Bengkel Service Mobil & Penjualan Sparepart Terpercaya')">
    <meta name="keywords" content="bengkel mobil, service mobil, sparepart mobil, joni motor">
    <title>@yield('title', 'Joni Motor - Service & Sparepart Mobil')</title>

    {{-- Bootstrap 5 + Bootstrap Icons via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- AOS Animations --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    
    @yield('styles')

    <style>
        /* ============================================================
           GLOBAL ROOT TOKENS — RED DARK MODE
        ============================================================ */
        :root {
            --red-900:  #1a0505;
            --red-800:  #220808;
            --red-700:  #2d0c0c;
            --red-600:  #3d1111;
            --red-500:  #7f1d1d;
            --red-400:  #b91c1c;
            --red-300:  #dc2626;
            --red-200:  #ef4444;
            --red-100:  #fca5a5;
            --red-50:   #fee2e2;

            --bg-primary:   #0d0606;
            --bg-secondary: #130909;
            --bg-card:      #1a0c0c;
            --bg-elevated:  #230f0f;
            --bg-hover:     #2d1414;

            --border:       rgba(220, 38, 38, 0.12);
            --border-hover: rgba(220, 38, 38, 0.30);
            --border-glow:  rgba(220, 38, 38, 0.50);

            --text-primary:   #fff1f1;
            --text-secondary: #c9a0a0;
            --text-muted:     #7a5555;

            --accent:       #dc2626;
            --accent-light: #ef4444;
            --accent-glow:  rgba(220, 38, 38, 0.35);
            --accent-faint: rgba(220, 38, 38, 0.10);

            --gold:         #f59e0b;
            --gold-glow:    rgba(245, 158, 11, 0.25);

            --gradient-hero: linear-gradient(135deg, #0d0606 0%, #1a0505 40%, #220808 100%);
            --gradient-red:  linear-gradient(135deg, #dc2626, #b91c1c);
            --gradient-card: linear-gradient(145deg, #1a0c0c, #130909);

            --radius:    16px;
            --radius-sm: 10px;
            --radius-xs: 6px;
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --font-main: 'Outfit', sans-serif;
        }

        /* ============================================================
           RESET & BASE
        ============================================================ */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-main);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; }

        /* ============================================================
           SCROLLBAR
        ============================================================ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-primary); }
        ::-webkit-scrollbar-thumb { background: var(--red-500); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* ============================================================
           REUSABLE UTILITIES
        ============================================================ */
        .text-accent   { color: var(--accent-light) !important; }
        .text-gold     { color: var(--gold) !important; }
        .text-muted-jm { color: var(--text-muted) !important; }
        .text-secondary-jm { color: var(--text-secondary) !important; }

        .bg-card       { background: var(--bg-card); }
        .bg-elevated   { background: var(--bg-elevated); }

        .border-red    { border-color: var(--border) !important; }

        .btn-jm-primary {
            background: var(--gradient-red);
            color: #fff;
            border: none;
            padding: 14px 34px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 0.3px;
            transition: all var(--transition);
            box-shadow: 0 0 20px var(--accent-glow), 0 4px 20px rgba(0,0,0,0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-main);
        }
        .btn-jm-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 35px var(--border-glow), 0 8px 30px rgba(0,0,0,0.5);
            color: #fff;
        }
        .btn-jm-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1.5px solid var(--border-hover);
            padding: 13px 34px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 15px;
            transition: all var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-main);
        }
        .btn-jm-outline:hover {
            border-color: var(--accent);
            color: var(--accent-light);
            background: var(--accent-faint);
            transform: translateY(-2px);
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent-faint);
            border: 1px solid rgba(220, 38, 38, 0.25);
            color: var(--accent-light);
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }
        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.15;
            color: var(--text-primary);
            letter-spacing: -0.5px;
        }
        .section-title span { color: var(--accent-light); }
        .section-subtitle {
            color: var(--text-secondary);
            font-size: 16px;
            font-weight: 400;
            line-height: 1.7;
            max-width: 560px;
        }

        .divider-red {
            width: 60px;
            height: 3px;
            background: var(--gradient-red);
            border-radius: 10px;
            margin: 14px 0 24px;
            box-shadow: 0 0 12px var(--accent-glow);
        }

        /* ============================================================
           CARD COMPONENT
        ============================================================ */
        .jm-card {
            background: var(--gradient-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: all var(--transition);
            overflow: hidden;
        }
        .jm-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 30px var(--accent-glow);
        }

        /* ============================================================
           GLOW EFFECTS
        ============================================================ */
        .glow-red  { box-shadow: 0 0 30px var(--accent-glow); }
        .glow-text { text-shadow: 0 0 30px rgba(220,38,38,0.6); }

        @media (max-width: 768px) {
            .btn-jm-primary, .btn-jm-outline { padding: 12px 24px; font-size: 14px; }
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    @yield('navbar')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @yield('footer')

    {{-- Bootstrap JS via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- AOS JS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true,
            offset: 60,
            easing: 'ease-out-cubic',
        });
    </script>

    @yield('scripts')

</body>
</html>
