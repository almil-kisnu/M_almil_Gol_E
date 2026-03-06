<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Pengeluaran - Panel Manajemen">
    <title>Pengeluaran | Admin Panel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS (untuk Alert Validasi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

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
            --red-glow:    rgba(247,95,95,0.25);
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

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--blue), var(--purple));
            color: #fff;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 8px;
            transition: opacity var(--transition);
            box-shadow: 0 4px 16px var(--blue-glow);
            cursor: pointer;
            border: none;
        }
        .btn-primary-custom:hover { opacity: 0.88; color: #fff; }
        .btn-primary-custom svg { width: 15px; height: 15px; }

        .btn-danger-custom {
            background: rgba(247,95,95,0.12);
            color: var(--red);
            border: 1px solid rgba(247,95,95,0.25);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            transition: all var(--transition);
            cursor: pointer;
        }
        .btn-danger-custom:hover { background: rgba(247,95,95,0.22); border-color: var(--red); }

        .btn-edit-custom {
            background: rgba(79,142,247,0.12);
            color: var(--blue);
            border: 1px solid rgba(79,142,247,0.25);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            transition: all var(--transition);
            cursor: pointer;
        }
        .btn-edit-custom:hover { background: rgba(79,142,247,0.22); border-color: var(--blue); }

        /* =================== SUMMARY CARDS =================== */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 26px;
        }
        .summary-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            transition: all var(--transition);
            position: relative;
            overflow: hidden;
        }
        .summary-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
        }
        .summary-card.orange::before { background: linear-gradient(90deg, var(--orange), #ffcb47); }
        .summary-card.red::before    { background: linear-gradient(90deg, var(--red), #ff8c8c); }
        .summary-card.blue::before   { background: linear-gradient(90deg, var(--blue), var(--purple)); }
        .summary-card:hover { border-color: var(--border-hover); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.3); }
        .summary-label { font-size: 12px; font-weight: 500; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }
        .summary-value { font-size: 28px; font-weight: 800; margin-top: 10px; }
        .summary-value.orange { color: var(--orange); }
        .summary-value.red    { color: var(--red); }
        .summary-value.blue   { color: var(--blue); }
        .summary-sub { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

        /* =================== CARD =================== */
        .card-custom {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .card-header-custom {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title-custom { font-size: 15px; font-weight: 700; }
        .card-subtitle-custom { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

        /* =================== DATATABLE CUSTOM STYLES =================== */
        .datatable-wrap { padding: 20px 22px; }

        /* Override DataTable styles for dark theme */
        #pengeluaranTable_wrapper .dataTables_length label,
        #pengeluaranTable_wrapper .dataTables_filter label,
        #pengeluaranTable_wrapper .dataTables_info,
        #pengeluaranTable_wrapper .dataTables_paginate {
            color: var(--text-secondary);
            font-size: 13px;
            font-family: 'Inter', sans-serif;
        }
        #pengeluaranTable_wrapper .dataTables_length select,
        #pengeluaranTable_wrapper .dataTables_filter input {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            padding: 6px 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            outline: none;
        }
        #pengeluaranTable_wrapper .dataTables_filter input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(79,142,247,0.1);
        }
        #pengeluaranTable_wrapper .dataTables_paginate .paginate_button {
            background: var(--bg-secondary) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-secondary) !important;
            border-radius: 6px !important;
            margin: 0 2px;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
        }
        #pengeluaranTable_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--bg-hover) !important;
            border-color: var(--blue) !important;
            color: var(--blue) !important;
        }
        #pengeluaranTable_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--blue), var(--purple)) !important;
            border-color: transparent !important;
            color: #fff !important;
        }
        #pengeluaranTable_wrapper .dataTables_paginate .paginate_button.disabled,
        #pengeluaranTable_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: var(--text-muted) !important;
            background: transparent !important;
            border-color: var(--border) !important;
        }

        table#pengeluaranTable { width: 100% !important; border-collapse: collapse; }
        table#pengeluaranTable thead th {
            padding: 12px 16px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.7px;
            color: var(--text-muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            background: var(--bg-card);
        }
        table#pengeluaranTable thead th.sorting::after,
        table#pengeluaranTable thead th.sorting_asc::after,
        table#pengeluaranTable thead th.sorting_desc::after {
            color: var(--text-muted);
        }
        table#pengeluaranTable tbody td {
            padding: 13px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            color: var(--text-primary);
        }
        table#pengeluaranTable tbody tr:last-child td { border-bottom: none; }
        table#pengeluaranTable tbody tr { transition: background var(--transition); }
        table#pengeluaranTable tbody tr:hover { background: var(--bg-hover); }
        table#pengeluaranTable.dataTable { border: none; }

        .no-num { font-weight: 700; color: var(--text-muted); font-size: 12px; }
        .desc-cell { font-weight: 500; }
        .total-cell { font-weight: 700; color: var(--orange); }
        .date-cell  { color: var(--text-secondary); font-size: 12px; }
        .actions-cell { display: flex; align-items: center; gap: 8px; white-space: nowrap; }

        /* =================== MODAL =================== */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity 0.25s ease;
        }
        .modal-overlay.show { opacity: 1; pointer-events: all; }
        .modal-custom {
            background: var(--bg-card);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius);
            width: 100%;
            max-width: 520px;
            margin: 16px;
            box-shadow: 0 24px 80px rgba(0,0,0,0.5);
            transform: scale(0.95) translateY(10px);
            transition: transform 0.25s ease;
        }
        .modal-overlay.show .modal-custom { transform: scale(1) translateY(0); }
        .modal-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .modal-title-custom { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-title-custom svg { width: 18px; height: 18px; color: var(--blue); }
        .modal-close-btn {
            width: 30px; height: 30px;
            border-radius: 6px;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            transition: all var(--transition);
            cursor: pointer;
        }
        .modal-close-btn:hover { border-color: var(--red); color: var(--red); }
        .modal-close-btn svg { width: 14px; height: 14px; }
        .modal-body-custom { padding: 24px; }
        .modal-footer-custom {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex; align-items: center; justify-content: flex-end; gap: 10px;
        }

        /* Form elements */
        .form-group-custom { margin-bottom: 18px; }
        .form-label-custom {
            display: block;
            font-size: 12px; font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase; letter-spacing: 0.4px;
        }
        .form-control-custom {
            width: 100%;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 10px 14px;
            color: var(--text-primary);
            font-size: 13px;
            outline: none;
            transition: border-color var(--transition);
            font-family: 'Inter', sans-serif;
        }
        .form-control-custom:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(79,142,247,0.1); }
        .form-control-custom::placeholder { color: var(--text-muted); }
        .form-control-custom.is-invalid { border-color: var(--red) !important; }

        /* Cancel button */
        .btn-cancel-custom {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 500;
            transition: all var(--transition);
            cursor: pointer;
        }
        .btn-cancel-custom:hover { border-color: var(--border-hover); color: var(--text-primary); }

        /* Confirm delete modal icon */
        .delete-icon {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: rgba(247,95,95,0.12);
            border: 2px solid rgba(247,95,95,0.3);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .delete-icon svg { width: 26px; height: 26px; color: var(--red); }

        /* Toast notification */
        .toast-notify {
            position: fixed;
            bottom: 28px; right: 28px;
            background: var(--bg-card);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.4);
            z-index: 9999;
            transform: translateY(80px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            max-width: 340px;
        }
        .toast-notify.show { transform: translateY(0); opacity: 1; }
        .toast-icon-wrap {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .toast-icon-wrap.success { background: var(--green-glow); color: var(--green); }
        .toast-icon-wrap.error   { background: var(--red-glow);   color: var(--red); }
        .toast-icon-wrap svg { width: 16px; height: 16px; }
        .toast-msg-text { font-size: 13px; font-weight: 500; flex: 1; }

        /* Bootstrap Alert Override for dark theme */
        .alert-danger-dark {
            background: rgba(247,95,95,0.12);
            border: 1px solid rgba(247,95,95,0.35);
            border-radius: var(--radius-sm);
            color: #ff9a9a;
            padding: 12px 16px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        .alert-danger-dark ul { margin: 0; padding-left: 20px; }
        .alert-danger-dark li { margin-top: 4px; }
        .alert-danger-dark .btn-close { filter: invert(1) brightness(2); }

        /* =================== ANIMATIONS =================== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate { animation: fadeInUp 0.4s ease both; }
        .delay-1 { animation-delay: 0.06s; }
        .delay-2 { animation-delay: 0.12s; }

        /* =================== SCROLLBAR =================== */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--bg-hover); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

        /* =================== RESPONSIVE =================== */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .summary-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 600px) {
            .summary-grid { grid-template-columns: 1fr; }
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

        <a class="nav-item" href="/admin" id="nav-dashboard">
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
        <a class="nav-item active" href="{{ route('admin.pengeluaran.index') }}" id="nav-pengeluaran">
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
            Manajemen <span>Pengeluaran</span>
        </div>
        <div class="header-actions">
            <button class="icon-btn" title="Notifikasi">
                <i data-feather="bell"></i>
            </button>
            <button class="icon-btn" title="Pengaturan">
                <i data-feather="settings"></i>
            </button>
        </div>
    </header>

    <!-- Content -->
    <div class="content">

        <!-- Page Header -->
        <div class="page-header animate">
            <div>
                <h1>Pengeluaran</h1>
                <p>Kelola data pengeluaran operasional dengan mudah.</p>
                <div class="breadcrumb" style="margin-top:8px;">
                    <i data-feather="home" style="width:12px;height:12px;"></i>
                    <span>/ Admin</span>
                    <span>/ Pengeluaran</span>
                </div>
            </div>
            <button class="btn-primary-custom" id="btn-tambah" onclick="openAddModal()">
                <i data-feather="plus"></i>
                Tambah Pengeluaran
            </button>
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid animate delay-1">
            <div class="summary-card orange">
                <div class="summary-label">Total Pengeluaran</div>
                <div class="summary-value orange">
                    Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}
                </div>
                <div class="summary-sub">Semua data tersimpan</div>
            </div>
            <div class="summary-card red">
                <div class="summary-label">Jumlah Data</div>
                <div class="summary-value red">{{ $pengeluaran->count() }}</div>
                <div class="summary-sub">Entri pengeluaran</div>
            </div>
            <div class="summary-card blue">
                <div class="summary-label">Rata-rata per Entri</div>
                <div class="summary-value blue">
                    Rp {{ $pengeluaran->count() > 0 ? number_format($totalKeseluruhan / $pengeluaran->count(), 0, ',', '.') : 0 }}
                </div>
                <div class="summary-sub">Per transaksi</div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card-custom animate delay-2">
            <div class="card-header-custom">
                <div>
                    <div class="card-title-custom">Data Pengeluaran</div>
                    <div class="card-subtitle-custom">Daftar lengkap semua pengeluaran (powered by DataTable)</div>
                </div>
            </div>

            <div class="datatable-wrap">
                <table id="pengeluaranTable" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Deskripsi</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengeluaran as $index => $item)
                        <tr>
                            <td class="no-num">{{ $index + 1 }}</td>
                            <td class="desc-cell">{{ $item->deskripsi }}</td>
                            <td class="total-cell" data-order="{{ $item->total }}">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td class="date-cell" data-order="{{ $item->tanggal->format('Y-m-d') }}">{{ $item->tanggal->translatedFormat('d F Y') }}</td>
                            <td>
                                <div class="actions-cell">
                                    <button class="btn-edit-custom"
                                        onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->deskripsi) }}', '{{ $item->total }}', '{{ $item->tanggal->format('Y-m-d') }}')">
                                        <i data-feather="edit-2" style="width:13px;height:13px;"></i>
                                        Edit
                                    </button>
                                    <button class="btn-danger-custom"
                                        onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->deskripsi) }}')">
                                        <i data-feather="trash-2" style="width:13px;height:13px;"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /content -->
</div><!-- /main -->


<!-- ==================== MODAL TAMBAH ==================== -->
<div class="modal-overlay" id="modalTambah">
    <div class="modal-custom">
        <div class="modal-header-custom">
            <div class="modal-title-custom">
                <i data-feather="plus-circle"></i>
                Tambah Pengeluaran
            </div>
            <button class="modal-close-btn" onclick="closeModal('modalTambah')">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('admin.pengeluaran.store') }}" method="POST" id="formTambah" novalidate>
            @csrf
            <div class="modal-body-custom">

                {{-- ===== ALERT BOOTSTRAP UNTUK ERROR VALIDASI (TAMBAH) ===== --}}
                @if ($errors->any() && old('_form_type') === 'tambah')
                <div class="alert alert-danger alert-danger-dark alert-dismissible fade show" role="alert" id="validasiErrorTambah">
                    <strong><i data-feather="alert-triangle" style="width:14px;height:14px;display:inline;margin-right:6px;"></i>Terdapat kesalahan input:</strong>
                    <ul class="mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <input type="hidden" name="_form_type" value="tambah">

                <div class="form-group-custom">
                    <label class="form-label-custom" for="add-deskripsi">Deskripsi *</label>
                    <input type="text"
                        class="form-control-custom {{ $errors->has('deskripsi') && old('_form_type') === 'tambah' ? 'is-invalid' : '' }}"
                        id="add-deskripsi" name="deskripsi"
                        placeholder="Contoh: Pembelian oli mesin, Bayar listrik..."
                        value="{{ old('_form_type') === 'tambah' ? old('deskripsi') : '' }}">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom" for="add-total">Total (Rp) *</label>
                    <input type="number"
                        class="form-control-custom {{ $errors->has('total') && old('_form_type') === 'tambah' ? 'is-invalid' : '' }}"
                        id="add-total" name="total"
                        placeholder="0" min="0" step="1000"
                        value="{{ old('_form_type') === 'tambah' ? old('total') : '' }}">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom" for="add-tanggal">Tanggal *</label>
                    <input type="date"
                        class="form-control-custom {{ $errors->has('tanggal') && old('_form_type') === 'tambah' ? 'is-invalid' : '' }}"
                        id="add-tanggal" name="tanggal"
                        value="{{ old('_form_type') === 'tambah' ? old('tanggal') : '' }}">
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel-custom" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn-primary-custom">
                    <i data-feather="save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL EDIT ==================== -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-custom">
        <div class="modal-header-custom">
            <div class="modal-title-custom">
                <i data-feather="edit-2"></i>
                Edit Pengeluaran
            </div>
            <button class="modal-close-btn" onclick="closeModal('modalEdit')">
                <i data-feather="x"></i>
            </button>
        </div>
        <form id="formEdit" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-body-custom">

                {{-- ===== ALERT BOOTSTRAP UNTUK ERROR VALIDASI (EDIT) ===== --}}
                @if ($errors->any() && old('_form_type') === 'edit')
                <div class="alert alert-danger alert-danger-dark alert-dismissible fade show" role="alert">
                    <strong><i data-feather="alert-triangle" style="width:14px;height:14px;display:inline;margin-right:6px;"></i>Terdapat kesalahan input:</strong>
                    <ul class="mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <input type="hidden" name="_form_type" value="edit">
                <input type="hidden" id="edit-id" name="_edit_id" value="">

                <div class="form-group-custom">
                    <label class="form-label-custom" for="edit-deskripsi">Deskripsi *</label>
                    <input type="text"
                        class="form-control-custom {{ $errors->has('deskripsi') && old('_form_type') === 'edit' ? 'is-invalid' : '' }}"
                        id="edit-deskripsi" name="deskripsi"
                        placeholder="Deskripsi pengeluaran..."
                        value="{{ old('_form_type') === 'edit' ? old('deskripsi') : '' }}">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom" for="edit-total">Total (Rp) *</label>
                    <input type="number"
                        class="form-control-custom {{ $errors->has('total') && old('_form_type') === 'edit' ? 'is-invalid' : '' }}"
                        id="edit-total" name="total"
                        placeholder="0" min="0" step="1000"
                        value="{{ old('_form_type') === 'edit' ? old('total') : '' }}">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom" for="edit-tanggal">Tanggal *</label>
                    <input type="date"
                        class="form-control-custom {{ $errors->has('tanggal') && old('_form_type') === 'edit' ? 'is-invalid' : '' }}"
                        id="edit-tanggal" name="tanggal"
                        value="{{ old('_form_type') === 'edit' ? old('tanggal') : '' }}">
                </div>
            </div>
            <div class="modal-footer-custom">
                <button type="button" class="btn-cancel-custom" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-primary-custom">
                    <i data-feather="save"></i>
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== MODAL HAPUS ==================== -->
<div class="modal-overlay" id="modalHapus">
    <div class="modal-custom" style="max-width: 400px;">
        <div class="modal-body-custom" style="text-align: center; padding: 32px 24px;">
            <div class="delete-icon">
                <i data-feather="trash-2"></i>
            </div>
            <h3 style="font-size: 17px; font-weight: 700; margin-bottom: 8px;">Konfirmasi Hapus</h3>
            <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.6;">
                Yakin ingin menghapus pengeluaran<br>
                "<strong id="deleteDesc" style="color: var(--text-primary);"></strong>"?<br>
                <span style="color: var(--red); font-size: 12px;">Tindakan ini tidak dapat dibatalkan.</span>
            </p>
        </div>
        <div style="padding: 16px 24px; border-top: 1px solid var(--border); display: flex; gap: 10px; justify-content: center;">
            <button class="btn-cancel-custom" onclick="closeModal('modalHapus')">Batal</button>
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="
                    background: linear-gradient(135deg, var(--red), #d94f4f);
                    color: #fff; border: none; padding: 10px 24px;
                    border-radius: var(--radius-sm); font-size: 13px;
                    font-weight: 600; cursor: pointer; display: flex;
                    align-items: center; gap: 8px;
                    box-shadow: 0 4px 16px var(--red-glow);
                ">
                    <i data-feather="trash-2" style="width:14px;height:14px;"></i>
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ==================== TOAST ==================== -->
<div class="toast-notify" id="toastNotify">
    <div class="toast-icon-wrap" id="toastIcon">
        <i data-feather="check-circle"></i>
    </div>
    <span class="toast-msg-text" id="toastMsg"></span>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<!-- Bootstrap JS (untuk dismiss alert) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ===== FEATHER ICONS =====
    feather.replace();

    // ===== DATATABLE INITIALIZATION =====
    $(document).ready(function () {
        $('#pengeluaranTable').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
            },
            order: [[3, 'desc']], // Default sort by date descending
            columnDefs: [
                { orderable: false, targets: [0, 4] }, // No & Aksi not sortable
                { searchable: false, targets: [0, 4] } // No & Aksi not searchable
            ],
            drawCallback: function () {
                // Re-number the "No" column after each draw/sort/filter
                this.api().column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = '<span class="no-num">' + (i + 1) + '</span>';
                });
                feather.replace();
            },
            initComplete: function () {
                feather.replace();
            }
        });
    });

    // ===== SET DEFAULT DATE =====
    document.getElementById('add-tanggal').value = new Date().toISOString().split('T')[0];

    // ===== SESSION FLASH =====
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
    @if(session('error'))
        showToast('{{ session('error') }}', 'error');
    @endif

    // ===== AUTO-OPEN MODAL IF VALIDATION ERROR =====
    @if($errors->any())
        @if(old('_form_type') === 'tambah')
            openModal('modalTambah');
        @elseif(old('_form_type') === 'edit')
            // Restore edit modal with old ID
            (function() {
                const editId = '{{ old('_edit_id') }}';
                if (editId) {
                    const form = document.getElementById('formEdit');
                    form.action = '/admin/pengeluaran/' + editId;
                    document.getElementById('edit-id').value = editId;
                }
            })();
            openModal('modalEdit');
        @endif
    @endif

    // ===== MODAL FUNCTIONS =====
    function openAddModal() {
        document.getElementById('formTambah').reset();
        document.getElementById('add-tanggal').value = new Date().toISOString().split('T')[0];
        // Remove validation highlights
        document.querySelectorAll('#formTambah .form-control-custom').forEach(el => el.classList.remove('is-invalid'));
        openModal('modalTambah');
    }

    function openEditModal(id, deskripsi, total, tanggal) {
        const form = document.getElementById('formEdit');
        form.action = `/admin/pengeluaran/${id}`;
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-deskripsi').value = deskripsi;
        document.getElementById('edit-total').value = total;
        document.getElementById('edit-tanggal').value = tanggal;
        // Remove validation highlights
        document.querySelectorAll('#formEdit .form-control-custom').forEach(el => el.classList.remove('is-invalid'));
        openModal('modalEdit');
    }

    function openDeleteModal(id, deskripsi) {
        document.getElementById('formHapus').action = `/admin/pengeluaran/${id}`;
        document.getElementById('deleteDesc').textContent = deskripsi;
        openModal('modalHapus');
    }

    function openModal(id) {
        document.getElementById(id).classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
        document.body.style.overflow = '';
    }

    // Click overlay to close
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    // Escape key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.show').forEach(m => closeModal(m.id));
        }
    });

    // ===== TOAST =====
    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toastNotify');
        const icon  = document.getElementById('toastIcon');
        const text  = document.getElementById('toastMsg');

        text.textContent = msg;
        icon.className = `toast-icon-wrap ${type}`;
        icon.innerHTML = type === 'success'
            ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>'
            : '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';

        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 4000);
    }
</script>

</body>
</html>
