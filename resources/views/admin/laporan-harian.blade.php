<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Twins - Laporan Harian">
    <title>Laporan Harian | Twins Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        /* =================== ROOT DESIGN TOKENS - TWINS THEME =================== */
        :root {
            --bg-primary:   #faf6f1;
            --bg-secondary: #fff8f0;
            --bg-card:      #ffffff;
            --bg-hover:     #fef0e0;
            --border:       rgba(139,94,60,0.12);
            --border-hover: rgba(139,94,60,0.25);

            --text-primary:   #2d1b0e;
            --text-secondary: #7a6555;
            --text-muted:     #b09a88;

            --orange:      #E8941A;
            --orange-glow: rgba(232,148,26,0.18);
            --blue:        #2B9CD8;
            --blue-glow:   rgba(43,156,216,0.18);
            --brown:       #8B5E3C;
            --brown-glow:  rgba(139,94,60,0.18);
            --red:         #CC3333;
            --red-glow:    rgba(204,51,51,0.18);
            --green:       #2E8B57;
            --green-glow:  rgba(46,139,87,0.18);
            --yellow:      #F5C542;

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
            background: linear-gradient(180deg, #2d1b0e 0%, #3d2815 100%);
            border-right: 1px solid rgba(255,255,255,0.06);
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
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 16px rgba(232,148,26,0.35);
        }
        .brand-icon svg { color: #fff; width: 20px; height: 20px; }
        .brand-text h2 { font-size: 18px; font-weight: 800; color: #fff; letter-spacing: 0.5px; }
        .brand-text p  { font-size: 11px; color: rgba(255,255,255,0.45); margin-top: 1px; }

        .sidebar-nav { flex: 1; padding: 20px 12px; overflow-y: auto; }
        .nav-section-label {
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1.2px;
            color: rgba(255,255,255,0.3);
            padding: 12px 8px 6px;
        }
        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px;
            border-radius: var(--radius-sm);
            color: rgba(255,255,255,0.55);
            font-size: 13.5px; font-weight: 500;
            transition: all var(--transition);
            position: relative;
            cursor: pointer;
            margin-bottom: 4px;
        }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: rgba(255,255,255,0.9); }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(232,148,26,0.25), rgba(245,197,66,0.15));
            color: var(--yellow);
            border: 1px solid rgba(232,148,26,0.3);
        }
        .nav-item.active svg { color: var(--yellow); }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .admin-profile {
            display: flex; align-items: center; gap: 11px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            transition: background var(--transition);
        }
        .admin-profile:hover { background: rgba(255,255,255,0.06); }
        .admin-avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; color: #fff;
            flex-shrink: 0;
        }
        .admin-info { flex: 1; min-width: 0; }
        .admin-name  { font-size: 13px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .admin-role  { font-size: 11px; color: rgba(255,255,255,0.4); }

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
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 28px;
            position: sticky; top: 0;
            z-index: 50;
            gap: 16px;
            box-shadow: 0 1px 8px rgba(139,94,60,0.06);
        }
        .header-title { font-size: 20px; font-weight: 700; flex: 1; }
        .header-title span { color: var(--orange); }
        .header-actions { display: flex; align-items: center; gap: 10px; }
        .icon-btn {
            width: 38px; height: 38px;
            border-radius: var(--radius-sm);
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            transition: all var(--transition);
            position: relative;
        }
        .icon-btn:hover { border-color: var(--orange); color: var(--orange); background: var(--orange-glow); }
        .icon-btn svg { width: 17px; height: 17px; }

        /* =================== CONTENT =================== */
        .content { padding: 28px; flex: 1; }

        .page-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        .page-header h1 { font-size: 26px; font-weight: 800; }
        .page-header p  { color: var(--text-secondary); font-size: 13px; margin-top: 4px; }
        .breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: 12px; color: var(--text-muted);
            background: none; padding: 0; margin: 0;
        }
        .breadcrumb span { color: var(--text-secondary); }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--orange), var(--yellow));
            color: #fff;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 8px;
            transition: opacity var(--transition);
            box-shadow: 0 4px 16px var(--orange-glow);
            cursor: pointer;
            border: none;
        }
        .btn-primary-custom:hover { opacity: 0.88; color: #fff; }
        .btn-primary-custom svg { width: 15px; height: 15px; }

        .btn-danger-custom {
            background: rgba(204,51,51,0.10);
            color: var(--red);
            border: 1px solid rgba(204,51,51,0.25);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            transition: all var(--transition);
            cursor: pointer;
        }
        .btn-danger-custom:hover { background: rgba(204,51,51,0.20); border-color: var(--red); }

        .btn-edit-custom {
            background: rgba(43,156,216,0.10);
            color: var(--blue);
            border: 1px solid rgba(43,156,216,0.25);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            transition: all var(--transition);
            cursor: pointer;
        }
        .btn-edit-custom:hover { background: rgba(43,156,216,0.20); border-color: var(--blue); }

        /* =================== CARD =================== */
        .card-custom {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(139,94,60,0.06);
        }
        .card-header-custom {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-title-custom { font-size: 15px; font-weight: 700; }
        .card-subtitle-custom { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

        /* =================== DATATABLE CUSTOM =================== */
        .datatable-wrap { padding: 20px 22px; }

        #laporanTable_wrapper .dataTables_length label,
        #laporanTable_wrapper .dataTables_filter label,
        #laporanTable_wrapper .dataTables_info,
        #laporanTable_wrapper .dataTables_paginate {
            color: var(--text-secondary);
            font-size: 13px;
            font-family: 'Inter', sans-serif;
        }
        #laporanTable_wrapper .dataTables_length select,
        #laporanTable_wrapper .dataTables_filter input {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            padding: 6px 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            outline: none;
        }
        #laporanTable_wrapper .dataTables_filter input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(232,148,26,0.12);
        }
        #laporanTable_wrapper .dataTables_paginate .paginate_button {
            background: var(--bg-secondary) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-secondary) !important;
            border-radius: 6px !important;
            margin: 0 2px;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
        }
        #laporanTable_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--bg-hover) !important;
            border-color: var(--orange) !important;
            color: var(--orange) !important;
        }
        #laporanTable_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--orange), var(--yellow)) !important;
            border-color: transparent !important;
            color: #fff !important;
        }
        #laporanTable_wrapper .dataTables_paginate .paginate_button.disabled,
        #laporanTable_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: var(--text-muted) !important;
            background: transparent !important;
            border-color: var(--border) !important;
        }

        table#laporanTable { width: 100% !important; border-collapse: collapse; }
        table#laporanTable thead th {
            padding: 12px 16px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.7px;
            color: var(--text-muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            background: var(--bg-card);
        }
        table#laporanTable tbody td {
            padding: 13px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            color: var(--text-primary);
        }
        table#laporanTable tbody tr:last-child td { border-bottom: none; }
        table#laporanTable tbody tr { transition: background var(--transition); }
        table#laporanTable tbody tr:hover { background: var(--bg-hover); }
        table#laporanTable.dataTable { border: none; }

        .no-num { font-weight: 700; color: var(--text-muted); font-size: 12px; }
        .date-cell  { color: var(--text-secondary); font-size: 12px; }
        .money-cell { font-weight: 700; }
        .money-cell.orange { color: var(--orange); }
        .money-cell.blue   { color: var(--blue); }
        .selisih-positive { font-weight: 700; color: var(--green); }
        .selisih-negative { font-weight: 700; color: var(--red); }
        .selisih-zero     { font-weight: 700; color: var(--text-muted); }
        .actions-cell { display: flex; align-items: center; gap: 8px; white-space: nowrap; }

        /* =================== MODAL =================== */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(45,27,14,0.6);
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
            box-shadow: 0 24px 80px rgba(45,27,14,0.3);
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
        .modal-title-custom svg { width: 18px; height: 18px; color: var(--orange); }
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
        .form-control-custom:focus { border-color: var(--orange); box-shadow: 0 0 0 3px rgba(232,148,26,0.12); }
        .form-control-custom::placeholder { color: var(--text-muted); }
        .form-control-custom.is-invalid { border-color: var(--red) !important; }

        .form-hint {
            font-size: 11px; color: var(--text-muted); margin-top: 6px;
            display: flex; align-items: center; gap: 4px;
        }
        .form-hint svg { width: 12px; height: 12px; }

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

        .delete-icon {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: rgba(204,51,51,0.10);
            border: 2px solid rgba(204,51,51,0.25);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
        }
        .delete-icon svg { width: 26px; height: 26px; color: var(--red); }

        /* Toast */
        .toast-notify {
            position: fixed;
            bottom: 28px; right: 28px;
            background: var(--bg-card);
            border: 1px solid var(--border-hover);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            display: flex; align-items: center; gap: 12px;
            box-shadow: 0 8px 30px rgba(45,27,14,0.2);
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

        /* Alert */
        .alert-danger-dark {
            background: rgba(204,51,51,0.08);
            border: 1px solid rgba(204,51,51,0.25);
            border-radius: var(--radius-sm);
            color: var(--red);
            padding: 12px 16px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        .alert-danger-dark ul { margin: 0; padding-left: 20px; }
        .alert-danger-dark li { margin-top: 4px; }
        .alert-danger-dark .btn-close { filter: none; }

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
        ::-webkit-scrollbar-thumb { background: var(--border-hover); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

        /* =================== RESPONSIVE =================== */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
        }
    </style>
</head>
<body>

<!-- ==================== SIDEBAR ==================== -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i data-feather="shopping-cart"></i>
        </div>
        <div class="brand-text">
            <h2>Twins</h2>
            <p>Admin Panel</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <p class="nav-section-label">Menu</p>

        <a class="nav-item" href="/admin" id="nav-transaksi">
            <i data-feather="list"></i>
            Riwayat Transaksi
        </a>
        <a class="nav-item" href="/admin/pengeluaran" id="nav-pengeluaran">
            <i data-feather="trending-down"></i>
            Pengeluaran
        </a>
        <a class="nav-item active" href="{{ route('admin.laporan-harian.index') }}" id="nav-laporan">
            <i data-feather="file-text"></i>
            Laporan Harian
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-profile">
            <div class="admin-avatar">T</div>
            <div class="admin-info">
                <div class="admin-name">Twins Admin</div>
                <div class="admin-role">Administrator</div>
            </div>
            <i data-feather="log-out" style="width:15px;height:15px;color:rgba(255,255,255,0.3);flex-shrink:0;"></i>
        </div>
    </div>
</aside>

<!-- ==================== MAIN ==================== -->
<div class="main">

    <!-- Header -->
    <header class="header">
        <div class="header-title">
            Laporan <span>Harian</span>
        </div>
        <div class="header-actions">
            <button class="icon-btn" title="Refresh" onclick="location.reload()">
                <i data-feather="refresh-cw"></i>
            </button>
        </div>
    </header>

    <!-- Content -->
    <div class="content">

        <!-- Page Header -->
        <div class="page-header animate">
            <div>
                <h1>Laporan Harian</h1>
                <p>Rekap perbandingan uang digital dan uang fisik harian.</p>
                <div class="breadcrumb" style="margin-top:8px;">
                    <i data-feather="home" style="width:12px;height:12px;"></i>
                    <span>/ Admin</span>
                    <span>/ Laporan Harian</span>
                </div>
            </div>
            <button class="btn-primary-custom" id="btn-tambah" onclick="openAddModal()">
                <i data-feather="plus"></i>
                Tambah Laporan
            </button>
        </div>

        <!-- Table Card -->
        <div class="card-custom animate delay-1">
            <div class="card-header-custom">
                <div>
                    <div class="card-title-custom">Data Laporan Harian</div>
                    <div class="card-subtitle-custom">Uang Digital = SUM(Transaksi) - SUM(Pengeluaran) per hari · Selisih = Uang Fisik - Uang Digital</div>
                </div>
            </div>

            <div class="datatable-wrap">
                <table id="laporanTable" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Tanggal</th>
                            <th>Uang Fisik</th>
                            <th>Uang Digital</th>
                            <th>Selisih</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanHarian as $index => $item)
                        <tr>
                            <td class="no-num">{{ $index + 1 }}</td>
                            <td class="date-cell" data-order="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="money-cell orange" data-order="{{ $item->uang_fisik }}">Rp {{ number_format($item->uang_fisik, 0, ',', '.') }}</td>
                            <td class="money-cell blue" data-order="{{ $item->uang_digital }}">Rp {{ number_format($item->uang_digital, 0, ',', '.') }}</td>
                            <td data-order="{{ $item->selisih }}">
                                @if($item->selisih > 0)
                                    <span class="selisih-positive">+Rp {{ number_format($item->selisih, 0, ',', '.') }}</span>
                                @elseif($item->selisih < 0)
                                    <span class="selisih-negative">-Rp {{ number_format(abs($item->selisih), 0, ',', '.') }}</span>
                                @else
                                    <span class="selisih-zero">Rp 0</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <button class="btn-edit-custom"
                                        onclick="openEditModal({{ $item->id }}, '{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}', '{{ $item->uang_fisik }}')">
                                        <i data-feather="edit-2" style="width:13px;height:13px;"></i>
                                        Edit
                                    </button>
                                    <button class="btn-danger-custom"
                                        onclick="openDeleteModal({{ $item->id }}, '{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}')">
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

        <!-- Footer -->
        <div style="text-align:center;color:var(--text-muted);font-size:12px;padding:20px 0;">
            © 2026 Twins Admin Panel · Laravel {{ app()->version() }}
        </div>

    </div><!-- /content -->
</div><!-- /main -->


<!-- ==================== MODAL TAMBAH ==================== -->
<div class="modal-overlay" id="modalTambah">
    <div class="modal-custom">
        <div class="modal-header-custom">
            <div class="modal-title-custom">
                <i data-feather="plus-circle"></i>
                Tambah Laporan Harian
            </div>
            <button class="modal-close-btn" onclick="closeModal('modalTambah')">
                <i data-feather="x"></i>
            </button>
        </div>
        <form action="{{ route('admin.laporan-harian.store') }}" method="POST" id="formTambah" novalidate>
            @csrf
            <div class="modal-body-custom">

                @if ($errors->any() && old('_form_type') === 'tambah')
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

                <input type="hidden" name="_form_type" value="tambah">

                <div class="form-group-custom">
                    <label class="form-label-custom" for="add-tanggal">Tanggal *</label>
                    <input type="date"
                        class="form-control-custom {{ $errors->has('tanggal') && old('_form_type') === 'tambah' ? 'is-invalid' : '' }}"
                        id="add-tanggal" name="tanggal"
                        value="{{ old('_form_type') === 'tambah' ? old('tanggal') : '' }}">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom" for="add-uang-fisik">Uang Fisik (Rp) *</label>
                    <input type="number"
                        class="form-control-custom {{ $errors->has('uang_fisik') && old('_form_type') === 'tambah' ? 'is-invalid' : '' }}"
                        id="add-uang-fisik" name="uang_fisik"
                        placeholder="Jumlah uang tunai di kasir" min="0" step="1000"
                        value="{{ old('_form_type') === 'tambah' ? old('uang_fisik') : '' }}">
                    <div class="form-hint">
                        <i data-feather="info"></i>
                        Uang Digital & Selisih akan dihitung otomatis dari data transaksi & pengeluaran
                    </div>
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
                Edit Laporan Harian
            </div>
            <button class="modal-close-btn" onclick="closeModal('modalEdit')">
                <i data-feather="x"></i>
            </button>
        </div>
        <form id="formEdit" method="POST" novalidate>
            @csrf
            @method('PUT')
            <div class="modal-body-custom">

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
                    <label class="form-label-custom" for="edit-tanggal">Tanggal *</label>
                    <input type="date"
                        class="form-control-custom {{ $errors->has('tanggal') && old('_form_type') === 'edit' ? 'is-invalid' : '' }}"
                        id="edit-tanggal" name="tanggal"
                        value="{{ old('_form_type') === 'edit' ? old('tanggal') : '' }}">
                </div>
                <div class="form-group-custom">
                    <label class="form-label-custom" for="edit-uang-fisik">Uang Fisik (Rp) *</label>
                    <input type="number"
                        class="form-control-custom {{ $errors->has('uang_fisik') && old('_form_type') === 'edit' ? 'is-invalid' : '' }}"
                        id="edit-uang-fisik" name="uang_fisik"
                        placeholder="Jumlah uang tunai" min="0" step="1000"
                        value="{{ old('_form_type') === 'edit' ? old('uang_fisik') : '' }}">
                    <div class="form-hint">
                        <i data-feather="info"></i>
                        Uang Digital & Selisih akan dihitung ulang otomatis
                    </div>
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
                Yakin ingin menghapus laporan tanggal<br>
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
                    background: linear-gradient(135deg, var(--red), #a52929);
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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    feather.replace();

    $(document).ready(function () {
        $('#laporanTable').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
            },
            order: [[1, 'desc']],
            columnDefs: [
                { orderable: false, targets: [0, 5] },
                { searchable: false, targets: [0, 5] }
            ],
            drawCallback: function () {
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

    document.getElementById('add-tanggal').value = new Date().toISOString().split('T')[0];

    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
    @if(session('error'))
        showToast('{{ session('error') }}', 'error');
    @endif

    @if($errors->any())
        @if(old('_form_type') === 'tambah')
            openModal('modalTambah');
        @elseif(old('_form_type') === 'edit')
            (function() {
                const editId = '{{ old('_edit_id') }}';
                if (editId) {
                    const form = document.getElementById('formEdit');
                    form.action = '/admin/laporan-harian/' + editId;
                    document.getElementById('edit-id').value = editId;
                }
            })();
            openModal('modalEdit');
        @endif
    @endif

    function openAddModal() {
        document.getElementById('formTambah').reset();
        document.getElementById('add-tanggal').value = new Date().toISOString().split('T')[0];
        document.querySelectorAll('#formTambah .form-control-custom').forEach(el => el.classList.remove('is-invalid'));
        openModal('modalTambah');
    }

    function openEditModal(id, tanggal, uangFisik) {
        const form = document.getElementById('formEdit');
        form.action = `/admin/laporan-harian/${id}`;
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-tanggal').value = tanggal;
        document.getElementById('edit-uang-fisik').value = uangFisik;
        document.querySelectorAll('#formEdit .form-control-custom').forEach(el => el.classList.remove('is-invalid'));
        openModal('modalEdit');
    }

    function openDeleteModal(id, label) {
        document.getElementById('formHapus').action = `/admin/laporan-harian/${id}`;
        document.getElementById('deleteDesc').textContent = label;
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

    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.show').forEach(m => closeModal(m.id));
        }
    });

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
