<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Dashboard - Panel Manajemen Modern">
    <title>Admin Dashboard | Panel Manajemen</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* =================== ROOT DESIGN TOKENS =================== */
        :root {
            --bg-primary:   #0f1117;
            --bg-secondary: #1a1d27;
            --bg-card:      #1e2130;
            --bg-hover:     #252840;
            --border:       rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.14);

            --text-primary:   #f0f2ff;
            --text-secondary: #8b8fa8;
            --text-muted:     #5a5e75;

            --blue:        #4f8ef7;
            --blue-glow:   rgba(79,142,247,0.25);
            --purple:      #9b7ff4;
            --purple-glow: rgba(155,127,244,0.25);
            --green:       #3ecf8e;
            --green-glow:  rgba(62,207,142,0.25);
            --orange:      #f7904f;
            --orange-glow: rgba(247,144,79,0.25);
            --red:         #f75f5f;
            --teal:        #3ecfcf;

            --sidebar-w: 260px;
            --header-h:  68px;
            --radius:    14px;
            --radius-sm: 8px;
            --transition: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* =================== RESET & BASE =================== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }
        ul { list-style: none; }
        button { cursor: pointer; border: none; background: none; font-family: inherit; }

        /* =================== SIDEBAR =================== */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--bg-secondary);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            transition: transform var(--transition);
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 22px 20px;
            border-bottom: 1px solid var(--border);
        }
        .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--blue), var(--purple));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 16px var(--blue-glow);
        }
        .brand-icon svg { color: #fff; width: 20px; height: 20px; }
        .brand-text h2 { font-size: 16px; font-weight: 700; color: var(--text-primary); }
        .brand-text p  { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .nav-section-label {
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1.2px;
            color: var(--text-muted);
            padding: 12px 8px 6px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            font-size: 13.5px; font-weight: 500;
            transition: all var(--transition);
            position: relative;
            cursor: pointer;
            margin-bottom: 2px;
        }
        .nav-item:hover { background: var(--bg-hover); color: var(--text-primary); }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(79,142,247,0.15), rgba(155,127,244,0.12));
            color: var(--blue);
            border: 1px solid rgba(79,142,247,0.2);
        }
        .nav-item.active svg { color: var(--blue); }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; }
        .nav-badge {
            margin-left: auto;
            background: var(--blue);
            color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }
        .nav-badge.red { background: var(--red); }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border);
        }
        .admin-profile {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            transition: background var(--transition);
        }
        .admin-profile:hover { background: var(--bg-hover); }
        .admin-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--purple), var(--blue));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; color: #fff;
            flex-shrink: 0;
        }
        .admin-info { flex: 1; min-width: 0; }
        .admin-name  { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-role  { font-size: 11px; color: var(--text-muted); }

        /* =================== MAIN AREA =================== */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* =================== HEADER =================== */
        .header {
            height: var(--header-h);
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 28px;
            position: sticky; top: 0;
            z-index: 50;
            gap: 16px;
        }
        .header-title { font-size: 20px; font-weight: 700; flex: 1; }
        .header-title span { color: var(--blue); }
        .header-search {
            position: relative;
            width: 240px;
        }
        .header-search input {
            width: 100%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px 8px 38px;
            color: var(--text-primary);
            font-size: 13px;
            outline: none;
            transition: border-color var(--transition);
            font-family: 'Inter', sans-serif;
        }
        .header-search input:focus { border-color: var(--blue); }
        .header-search input::placeholder { color: var(--text-muted); }
        .header-search svg {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            width: 15px; height: 15px;
        }
        .header-actions { display: flex; align-items: center; gap: 10px; }
        .icon-btn {
            width: 38px; height: 38px;
            border-radius: var(--radius-sm);
            background: var(--bg-card);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            transition: all var(--transition);
            position: relative;
        }
        .icon-btn:hover { border-color: var(--blue); color: var(--blue); background: rgba(79,142,247,0.08); }
        .icon-btn svg { width: 17px; height: 17px; }
        .notif-dot {
            position: absolute; top: 7px; right: 7px;
            width: 7px; height: 7px;
            background: var(--red);
            border-radius: 50%;
            border: 2px solid var(--bg-secondary);
        }

        /* =================== CONTENT =================== */
        .content { padding: 28px; flex: 1; }

        /* Page Header */
        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        .page-header h1 { font-size: 26px; font-weight: 800; }
        .page-header p  { color: var(--text-secondary); font-size: 13px; margin-top: 4px; }
        .breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; color: var(--text-muted);
        }
        .breadcrumb span { color: var(--text-secondary); }
        .btn-primary {
            background: linear-gradient(135deg, var(--blue), var(--purple));
            color: #fff;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 8px;
            transition: opacity var(--transition);
            box-shadow: 0 4px 16px var(--blue-glow);
        }
        .btn-primary:hover { opacity: 0.88; }
        .btn-primary svg { width: 15px; height: 15px; }

        /* =================== STATS CARDS =================== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 26px;
        }
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            transition: all var(--transition);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
        }
        .stat-card.blue::before   { background: linear-gradient(90deg, var(--blue), var(--purple)); }
        .stat-card.purple::before { background: linear-gradient(90deg, var(--purple), #d97aff); }
        .stat-card.green::before  { background: linear-gradient(90deg, var(--green), #2ec4b6); }
        .stat-card.orange::before { background: linear-gradient(90deg, var(--orange), #ffcb47); }
        .stat-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .stat-top { display: flex; align-items: flex-start; justify-content: space-between; }
        .stat-label {
            font-size: 12px; font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .stat-icon {
            width: 42px; height: 42px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .stat-icon.blue   { background: var(--blue-glow);   color: var(--blue); }
        .stat-icon.purple { background: var(--purple-glow); color: var(--purple); }
        .stat-icon.green  { background: var(--green-glow);  color: var(--green); }
        .stat-icon.orange { background: var(--orange-glow); color: var(--orange); }
        .stat-icon svg { width: 20px; height: 20px; }
        .stat-value {
            font-size: 30px; font-weight: 800;
            margin-top: 14px;
            letter-spacing: -1px;
        }
        .stat-change {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 12px; font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
            margin-top: 8px;
        }
        .stat-change.up   { background: rgba(62,207,142,0.15); color: var(--green); }
        .stat-change.down { background: rgba(247,95,95,0.15);  color: var(--red); }
        .stat-change svg  { width: 12px; height: 12px; }
        .stat-sub { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

        /* =================== GRID 2-COL =================== */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .grid-3-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* =================== CARD =================== */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title {
            font-size: 15px; font-weight: 700;
        }
        .card-subtitle { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
        .card-body { padding: 22px; }
        .card-link {
            font-size: 12px; font-weight: 600; color: var(--blue);
            display: flex; align-items: center; gap: 4px;
            transition: gap var(--transition);
        }
        .card-link:hover { gap: 8px; }
        .card-link svg { width: 13px; height: 13px; }

        /* =================== CHART =================== */
        .chart-tabs {
            display: flex; gap: 6px;
        }
        .chart-tab {
            font-size: 12px; font-weight: 600;
            padding: 5px 12px;
            border-radius: 6px;
            color: var(--text-muted);
            transition: all var(--transition);
        }
        .chart-tab.active { background: rgba(79,142,247,0.15); color: var(--blue); }
        .chart-tab:hover  { color: var(--text-primary); }
        .chart-wrap { position: relative; height: 220px; margin-top: 8px; }

        /* =================== TABLE =================== */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 12px 16px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.7px;
            color: var(--text-muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        tbody td {
            padding: 13px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr { transition: background var(--transition); }
        tbody tr:hover { background: var(--bg-hover); }
        .order-id { font-weight: 600; color: var(--blue); font-size: 12px; }
        .customer-cell { display: flex; align-items: center; gap: 10px; }
        .cust-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            font-size: 12px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .amount { font-weight: 700; }

        /* Status badges */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px; font-weight: 600;
        }
        .badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
        }
        .badge-selesai    { background: rgba(62,207,142,0.15);  color: var(--green); }
        .badge-dikirim    { background: rgba(79,142,247,0.15);  color: var(--blue); }
        .badge-diproses   { background: rgba(247,144,79,0.15);  color: var(--orange); }
        .badge-dibatalkan { background: rgba(247,95,95,0.15);   color: var(--red); }
        .badge-aktif      { background: rgba(62,207,142,0.15);  color: var(--green); }
        .badge-nonaktif   { background: rgba(247,95,95,0.15);   color: var(--red); }
        .badge-admin      { background: rgba(155,127,244,0.15); color: var(--purple); }
        .badge-editor     { background: rgba(79,142,247,0.15);  color: var(--blue); }
        .badge-viewer     { background: rgba(90,94,117,0.3);    color: var(--text-secondary); }

        /* =================== TOP PRODUCTS =================== */
        .product-item {
            padding: 14px 0;
            border-bottom: 1px solid var(--border);
        }
        .product-item:last-child { border-bottom: none; padding-bottom: 0; }
        .product-item:first-child { padding-top: 0; }
        .product-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .product-name { font-size: 13px; font-weight: 600; }
        .product-meta { font-size: 12px; color: var(--text-secondary); }
        .product-stats { display: flex; gap: 16px; font-size: 12px; color: var(--text-muted); }
        .product-stats strong { color: var(--text-primary); }
        .progress-bar {
            height: 4px;
            background: var(--bg-hover);
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--blue), var(--purple));
            transition: width 1s ease;
        }

        /* =================== ACTIVITY FEED =================== */
        .activity-item {
            display: flex; gap: 14px;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .activity-icon svg { width: 16px; height: 16px; }
        .activity-icon.green  { background: var(--green-glow);  color: var(--green); }
        .activity-icon.blue   { background: var(--blue-glow);   color: var(--blue); }
        .activity-icon.purple { background: var(--purple-glow); color: var(--purple); }
        .activity-icon.red    { background: rgba(247,95,95,0.15); color: var(--red); }
        .activity-icon.orange { background: var(--orange-glow); color: var(--orange); }
        .activity-icon.teal   { background: rgba(62,207,207,0.15); color: var(--teal); }
        .activity-text { flex: 1; }
        .activity-text strong { font-weight: 600; font-size: 13px; }
        .activity-desc { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }
        .activity-desc em { color: var(--blue); font-style: normal; font-weight: 500; }
        .activity-time { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

        /* =================== MINI STATS ROW =================== */
        .mini-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 14px; margin-bottom: 20px;
        }
        .mini-stat {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
            text-align: center;
            transition: all var(--transition);
        }
        .mini-stat:hover { border-color: var(--border-hover); transform: translateY(-2px); }
        .mini-stat-value { font-size: 24px; font-weight: 800; }
        .mini-stat-label { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

        /* =================== SCROLLBAR =================== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--bg-hover); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

        /* =================== ANIMATIONS =================== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate { animation: fadeInUp 0.5s ease both; }
        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.10s; }
        .delay-3 { animation-delay: 0.15s; }
        .delay-4 { animation-delay: 0.20s; }

        /* =================== RESPONSIVE =================== */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .grid-3-1 { grid-template-columns: 1fr; }
        }
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .grid-2 { grid-template-columns: 1fr; }
        }
        @media (max-width: 600px) {
            .stats-grid { grid-template-columns: 1fr; }
            .mini-stats { grid-template-columns: 1fr; }
            .header-search { display: none; }
        }
    </style>
</head>
<body>

<!-- ==================== SIDEBAR ==================== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i data-feather="cpu"></i>
        </div>
        <div class="brand-text">
            <h2>AdminPro</h2>
            <p>Control Panel v2.0</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <p class="nav-section-label">Utama</p>

        <a class="nav-item active" href="/admin" id="nav-dashboard">
            <i data-feather="grid"></i>
            Dashboard
        </a>
        <a class="nav-item" href="#" id="nav-analytics">
            <i data-feather="bar-chart-2"></i>
            Analitik
            <span class="nav-badge">Baru</span>
        </a>

        <p class="nav-section-label" style="margin-top:10px;">Manajemen</p>

        <a class="nav-item" href="#" id="nav-products">
            <i data-feather="box"></i>
            Produk
        </a>
        <a class="nav-item" href="#" id="nav-orders">
            <i data-feather="shopping-cart"></i>
            Pesanan
            <span class="nav-badge red">7</span>
        </a>
        <a class="nav-item" href="#" id="nav-customers">
            <i data-feather="users"></i>
            Pelanggan
        </a>
        <a class="nav-item" href="/admin/pengeluaran" id="nav-pengeluaran">
            <i data-feather="trending-down"></i>
            Pengeluaran
        </a>
        <a class="nav-item" href="#" id="nav-reports">
            <i data-feather="file-text"></i>
            Laporan
        </a>

        <p class="nav-section-label" style="margin-top:10px;">Sistem</p>

        <a class="nav-item" href="#" id="nav-settings">
            <i data-feather="settings"></i>
            Pengaturan
        </a>
        <a class="nav-item" href="#" id="nav-notif">
            <i data-feather="bell"></i>
            Notifikasi
            <span class="nav-badge">3</span>
        </a>
        <a class="nav-item" href="#" id="nav-help">
            <i data-feather="help-circle"></i>
            Bantuan
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-profile">
            <div class="admin-avatar">A</div>
            <div class="admin-info">
                <div class="admin-name">Ahmad Admin</div>
                <div class="admin-role">Super Administrator</div>
            </div>
            <i data-feather="log-out" style="width:15px;height:15px;color:var(--text-muted);flex-shrink:0;"></i>
        </div>
    </div>
</aside>

<!-- ==================== MAIN ==================== -->
<div class="main">

    <!-- Header -->
    <header class="header">
        <div class="header-title">
            Panel <span>Admin</span>
        </div>
        <div class="header-search">
            <i data-feather="search"></i>
            <input type="text" id="global-search" placeholder="Cari apa saja..." autocomplete="off">
        </div>
        <div class="header-actions">
            <button class="icon-btn" title="Notifikasi" id="btn-notif">
                <i data-feather="bell"></i>
                <span class="notif-dot"></span>
            </button>
            <button class="icon-btn" title="Pesan" id="btn-msg">
                <i data-feather="message-square"></i>
            </button>
            <button class="icon-btn" title="Pengaturan" id="btn-settings">
                <i data-feather="settings"></i>
            </button>
        </div>
    </header>

    <!-- Content -->
    <div class="content">

        <!-- Page Header -->
        <div class="page-header animate">
            <div>
                <h1>Dashboard</h1>
                <p>Selamat datang kembali, Ahmad! Berikut ringkasan hari ini.</p>
                <div class="breadcrumb" style="margin-top:8px;">
                    <i data-feather="home" style="width:12px;height:12px;"></i>
                    <span>/ Dashboard</span>
                    <span style="color:var(--text-muted);">— Kamis, 26 Februari 2026</span>
                </div>
            </div>
            <button class="btn-primary" id="btn-export">
                <i data-feather="download"></i>
                Export Laporan
            </button>
        </div>

        <!-- ====== STATS CARDS ====== -->
        <div class="stats-grid">
            @foreach($stats as $i => $stat)
            <div class="stat-card {{ $stat['color'] }} animate delay-{{ $i + 1 }}">
                <div class="stat-top">
                    <div class="stat-label">{{ $stat['label'] }}</div>
                    <div class="stat-icon {{ $stat['color'] }}">
                        <i data-feather="{{ $stat['icon'] }}"></i>
                    </div>
                </div>
                <div class="stat-value">{{ $stat['value'] }}</div>
                <span class="stat-change {{ $stat['trend'] }}">
                    <i data-feather="{{ $stat['trend'] === 'up' ? 'trending-up' : 'trending-down' }}"></i>
                    {{ $stat['change'] }}
                </span>
                <div class="stat-sub">dibanding bulan lalu</div>
            </div>
            @endforeach
        </div>

        <!-- ====== MINI STATS ====== -->
        <div class="mini-stats animate delay-2">
            <div class="mini-stat">
                <div class="mini-stat-value" style="color: var(--green);">98.4%</div>
                <div class="mini-stat-label">Uptime Server</div>
            </div>
            <div class="mini-stat">
                <div class="mini-stat-value" style="color: var(--blue);">2.4 dtk</div>
                <div class="mini-stat-label">Rata-rata Waktu Respon</div>
            </div>
            <div class="mini-stat">
                <div class="mini-stat-value" style="color: var(--orange);">4.8/5</div>
                <div class="mini-stat-label">Rating Kepuasan</div>
            </div>
        </div>

        <!-- ====== CHART + ACTIVITY ====== -->
        <div class="grid-3-1">

            <!-- Revenue Chart -->
            <div class="card animate">
                <div class="card-header">
                    <div>
                        <div class="card-title">Grafik Pendapatan & Pesanan</div>
                        <div class="card-subtitle">12 bulan terakhir</div>
                    </div>
                    <div class="chart-tabs">
                        <button class="chart-tab active" id="tab-revenue" onclick="switchChart('revenue')">Pendapatan</button>
                        <button class="chart-tab"          id="tab-orders"  onclick="switchChart('orders')">Pesanan</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-wrap">
                        <canvas id="mainChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Activity Feed -->
            <div class="card animate delay-1">
                <div class="card-header">
                    <div>
                        <div class="card-title">Aktivitas Terkini</div>
                        <div class="card-subtitle">Real-time log</div>
                    </div>
                    <a href="#" class="card-link">
                        Lihat semua <i data-feather="arrow-right"></i>
                    </a>
                </div>
                <div class="card-body" style="padding: 12px 22px;">
                    @foreach($activities as $act)
                    <div class="activity-item">
                        <div class="activity-icon {{ $act['color'] }}">
                            <i data-feather="{{ $act['icon'] }}"></i>
                        </div>
                        <div class="activity-text">
                            <div>
                                <strong>{{ $act['user'] }}</strong>
                                <span style="font-size:12px;color:var(--text-secondary);font-weight:400;"> {{ $act['action'] }}</span>
                            </div>
                            <div class="activity-desc">→ <em>{{ $act['target'] }}</em></div>
                            <div class="activity-time">
                                <i data-feather="clock" style="width:10px;height:10px;display:inline;"></i>
                                {{ $act['time'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ====== ORDERS TABLE + TOP PRODUCTS ====== -->
        <div class="grid-3-1">

            <!-- Orders Table -->
            <div class="card animate">
                <div class="card-header">
                    <div>
                        <div class="card-title">Pesanan Terbaru</div>
                        <div class="card-subtitle">{{ count($orders) }} pesanan ditampilkan</div>
                    </div>
                    <a href="#" class="card-link">
                        Lihat semua <i data-feather="arrow-right"></i>
                    </a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $i => $order)
                            @php
                                $colors = ['#4f8ef7','#9b7ff4','#3ecf8e','#f7904f','#f75f5f','#3ecfcf','#ffcb47'];
                                $initials = strtoupper(substr($order['customer'], 0, 1));
                                $color = $colors[$i % count($colors)];
                                $statusClass = 'badge-' . strtolower(str_replace(' ', '', $order['status']));
                            @endphp
                            <tr>
                                <td><span class="order-id">{{ $order['id'] }}</span></td>
                                <td>
                                    <div class="customer-cell">
                                        <div class="cust-avatar" style="background: {{ $color }}22; color: {{ $color }};">{{ $initials }}</div>
                                        {{ $order['customer'] }}
                                    </div>
                                </td>
                                <td style="color:var(--text-secondary);font-size:12px;">{{ $order['product'] }}</td>
                                <td><span class="amount">{{ $order['amount'] }}</span></td>
                                <td><span class="badge {{ $statusClass }}">{{ $order['status'] }}</span></td>
                                <td style="color:var(--text-muted);font-size:12px;">{{ $order['date'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Products -->
            <div class="card animate delay-1">
                <div class="card-header">
                    <div>
                        <div class="card-title">Produk Terlaris</div>
                        <div class="card-subtitle">Berdasarkan penjualan</div>
                    </div>
                </div>
                <div class="card-body" style="padding: 14px 22px;">
                    @foreach($topProducts as $prod)
                    <div class="product-item">
                        <div class="product-row">
                            <span class="product-name">{{ $prod['name'] }}</span>
                            <span class="product-meta" style="font-weight:700;color:var(--green);">{{ $prod['revenue'] }}</span>
                        </div>
                        <div class="product-stats" style="margin-bottom:7px;">
                            <span>Terjual: <strong>{{ $prod['sold'] }}</strong></span>
                            <span>Stok: <strong>{{ $prod['stock'] }}</strong></span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $prod['pct'] }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ====== USERS TABLE ====== -->
        <div class="card animate" style="margin-bottom: 20px;">
            <div class="card-header">
                <div>
                    <div class="card-title">Pengguna Terbaru</div>
                    <div class="card-subtitle">Akun terdaftar baru-baru ini</div>
                </div>
                <a href="#" class="card-link">
                    Kelola pengguna <i data-feather="arrow-right"></i>
                </a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Bergabung</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $i => $user)
                        @php
                            $avatarColors = ['#4f8ef7','#9b7ff4','#3ecf8e','#f7904f','#3ecfcf'];
                            $roleClass  = 'badge-' . strtolower($user['role']);
                            $statClass  = 'badge-' . strtolower($user['status']);
                            $initials   = strtoupper(substr($user['name'],0,1));
                            $bgColor    = $avatarColors[$i % count($avatarColors)];
                        @endphp
                        <tr>
                            <td style="color:var(--text-muted);font-size:12px;">{{ $i + 1 }}</td>
                            <td>
                                <div class="customer-cell">
                                    <div class="cust-avatar" style="background: {{ $bgColor }}22; color: {{ $bgColor }};">{{ $initials }}</div>
                                    <span style="font-weight:600;">{{ $user['name'] }}</span>
                                </div>
                            </td>
                            <td style="color:var(--text-secondary);font-size:12px;">{{ $user['email'] }}</td>
                            <td><span class="badge {{ $roleClass }}">{{ $user['role'] }}</span></td>
                            <td style="color:var(--text-muted);font-size:12px;">{{ $user['joined'] }}</td>
                            <td><span class="badge {{ $statClass }}">{{ $user['status'] }}</span></td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <button class="icon-btn" style="width:30px;height:30px;font-size:11px;" title="Edit">
                                        <i data-feather="edit-2" style="width:13px;height:13px;"></i>
                                    </button>
                                    <button class="icon-btn" style="width:30px;height:30px;" title="Hapus">
                                        <i data-feather="trash-2" style="width:13px;height:13px;color:var(--red);"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align:center;color:var(--text-muted);font-size:12px;padding:16px 0;">
            © 2026 AdminPro Panel · Dibuat dengan ❤ · Laravel {{ app()->version() }}
        </div>

    </div><!-- /content -->
</div><!-- /main -->

<script>
    // Init Feather Icons
    feather.replace();

    // =================== CHART SETUP ===================
    const months  = @json($chartMonths);
    const revenue = @json($chartRevenue);
    const orders  = @json($chartOrders);

    const ctx = document.getElementById('mainChart').getContext('2d');

    const gradBlue   = ctx.createLinearGradient(0, 0, 0, 220);
    gradBlue.addColorStop(0,   'rgba(79,142,247,0.30)');
    gradBlue.addColorStop(1,   'rgba(79,142,247,0.00)');

    const gradPurple = ctx.createLinearGradient(0, 0, 0, 220);
    gradPurple.addColorStop(0, 'rgba(155,127,244,0.30)');
    gradPurple.addColorStop(1, 'rgba(155,127,244,0.00)');

    const chartConfig = {
        revenue: {
            label: 'Pendapatan (Juta Rp)',
            data: revenue,
            borderColor: '#4f8ef7',
            backgroundColor: gradBlue,
        },
        orders: {
            label: 'Total Pesanan',
            data: orders,
            borderColor: '#9b7ff4',
            backgroundColor: gradPurple,
        }
    };

    const mainChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: chartConfig.revenue.label,
                data: chartConfig.revenue.data,
                borderColor: chartConfig.revenue.borderColor,
                backgroundColor: chartConfig.revenue.backgroundColor,
                borderWidth: 2.5,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#4f8ef7',
                pointRadius: 4,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e2130',
                    borderColor: 'rgba(255,255,255,0.08)',
                    borderWidth: 1,
                    titleColor: '#f0f2ff',
                    bodyColor: '#8b8fa8',
                    padding: 12,
                    displayColors: false,
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: { color: '#5a5e75', font: { size: 11 } }
                },
                y: {
                    grid: { color: 'rgba(255,255,255,0.04)' },
                    ticks: { color: '#5a5e75', font: { size: 11 } }
                }
            }
        }
    });

    function switchChart(type) {
        const cfg = chartConfig[type];
        mainChart.data.datasets[0].label           = cfg.label;
        mainChart.data.datasets[0].data            = cfg.data;
        mainChart.data.datasets[0].borderColor     = cfg.borderColor;
        mainChart.data.datasets[0].backgroundColor = cfg.backgroundColor;
        mainChart.data.datasets[0].pointBackgroundColor = cfg.borderColor;
        mainChart.update();
        document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
        document.getElementById('tab-' + type).classList.add('active');
    }

    // =================== NAV ACTIVE ===================
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
            if (!this.href || this.href === '#' || this.getAttribute('href') === '#') {
                e.preventDefault();
            }
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // =================== BUTTON FEEDBACK ===================
    document.getElementById('btn-export').addEventListener('click', function() {
        this.innerHTML = '<i data-feather="check"></i> Diekspor!';
        feather.replace();
        setTimeout(() => {
            this.innerHTML = '<i data-feather="download"></i> Export Laporan';
            feather.replace();
        }, 2000);
    });

    // =================== SEARCH HIGHLIGHT ===================
    document.getElementById('global-search').addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        document.querySelectorAll('tbody tr').forEach(row => {
            row.style.display = (!q || row.textContent.toLowerCase().includes(q)) ? '' : 'none';
        });
    });
</script>
</body>
</html>
