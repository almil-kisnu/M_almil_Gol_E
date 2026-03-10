<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Twins - Riwayat Transaksi">
    <title>Riwayat Transaksi | Twins Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            background: none; padding: 0; margin: 0;
        }
        .breadcrumb span { color: var(--text-secondary); }

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
            box-shadow: 0 2px 12px rgba(139,94,60,0.06);
        }
        .summary-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .summary-card.orange::before { background: linear-gradient(90deg, var(--orange), var(--yellow)); }
        .summary-card.blue::before   { background: linear-gradient(90deg, var(--blue), #5bb8e8); }
        .summary-card.green::before  { background: linear-gradient(90deg, var(--green), #5cb85c); }
        .summary-card:hover { border-color: var(--border-hover); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(139,94,60,0.12); }
        .summary-label { font-size: 12px; font-weight: 500; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; }
        .summary-value { font-size: 28px; font-weight: 800; margin-top: 10px; }
        .summary-value.orange { color: var(--orange); }
        .summary-value.blue   { color: var(--blue); }
        .summary-value.green  { color: var(--green); }
        .summary-sub { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

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

        /* =================== DATATABLE CUSTOM STYLES =================== */
        .datatable-wrap { padding: 20px 22px; }

        #transaksiTable_wrapper .dataTables_length label,
        #transaksiTable_wrapper .dataTables_filter label,
        #transaksiTable_wrapper .dataTables_info,
        #transaksiTable_wrapper .dataTables_paginate {
            color: var(--text-secondary);
            font-size: 13px;
            font-family: 'Inter', sans-serif;
        }
        #transaksiTable_wrapper .dataTables_length select,
        #transaksiTable_wrapper .dataTables_filter input {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            padding: 6px 10px;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            outline: none;
        }
        #transaksiTable_wrapper .dataTables_filter input:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(232,148,26,0.12);
        }
        #transaksiTable_wrapper .dataTables_paginate .paginate_button {
            background: var(--bg-secondary) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-secondary) !important;
            border-radius: 6px !important;
            margin: 0 2px;
            font-size: 12px;
            font-family: 'Inter', sans-serif;
        }
        #transaksiTable_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--bg-hover) !important;
            border-color: var(--orange) !important;
            color: var(--orange) !important;
        }
        #transaksiTable_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--orange), var(--yellow)) !important;
            border-color: transparent !important;
            color: #fff !important;
        }
        #transaksiTable_wrapper .dataTables_paginate .paginate_button.disabled,
        #transaksiTable_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: var(--text-muted) !important;
            background: transparent !important;
            border-color: var(--border) !important;
        }

        table#transaksiTable { width: 100% !important; border-collapse: collapse; }
        table#transaksiTable thead th {
            padding: 12px 16px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.7px;
            color: var(--text-muted);
            text-align: left;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            background: var(--bg-card);
        }
        table#transaksiTable tbody td {
            padding: 13px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            color: var(--text-primary);
        }
        table#transaksiTable tbody tr:last-child td { border-bottom: none; }
        table#transaksiTable tbody tr { transition: background var(--transition); }
        table#transaksiTable tbody tr:hover { background: var(--bg-hover); }
        table#transaksiTable.dataTable { border: none; }

        .no-num { font-weight: 700; color: var(--text-muted); font-size: 12px; }
        .total-cell { font-weight: 700; color: var(--orange); }
        .bayar-cell { font-weight: 600; color: var(--green); }
        .kembalian-cell { font-weight: 600; color: var(--blue); }
        .date-cell  { color: var(--text-secondary); font-size: 12px; }

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
            <i data-feather="shopping-cart"></i>
        </div>
        <div class="brand-text">
            <h2>Twins</h2>
            <p>Admin Panel</p>
        </div>
    </div>

    <nav class="sidebar-nav">
        <p class="nav-section-label">Menu</p>

        <a class="nav-item active" href="/admin" id="nav-transaksi">
            <i data-feather="list"></i>
            Riwayat Transaksi
        </a>
        <a class="nav-item" href="/admin/pengeluaran" id="nav-pengeluaran">
            <i data-feather="trending-down"></i>
            Pengeluaran
        </a>
        <a class="nav-item" href="/admin/laporan-harian" id="nav-laporan">
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
            Riwayat <span>Transaksi</span>
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
                <h1>Riwayat Transaksi</h1>
                <p>Data seluruh transaksi penjualan (read-only).</p>
                <div class="breadcrumb" style="margin-top:8px;">
                    <i data-feather="home" style="width:12px;height:12px;"></i>
                    <span>/ Admin</span>
                    <span>/ Riwayat Transaksi</span>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid animate delay-1">
            <div class="summary-card orange">
                <div class="summary-label">Total Penjualan</div>
                <div class="summary-value orange">
                    Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
                </div>
                <div class="summary-sub">Semua transaksi tercatat</div>
            </div>
            <div class="summary-card blue">
                <div class="summary-label">Jumlah Transaksi</div>
                <div class="summary-value blue">{{ $transaksi->count() }}</div>
                <div class="summary-sub">Total entri</div>
            </div>
            <div class="summary-card green">
                <div class="summary-label">Rata-rata per Transaksi</div>
                <div class="summary-value green">
                    Rp {{ $transaksi->count() > 0 ? number_format($totalTransaksi / $transaksi->count(), 0, ',', '.') : 0 }}
                </div>
                <div class="summary-sub">Per transaksi</div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card-custom animate delay-2">
            <div class="card-header-custom">
                <div>
                    <div class="card-title-custom">Data Transaksi</div>
                    <div class="card-subtitle-custom">Semua riwayat transaksi penjualan</div>
                </div>
            </div>

            <div class="datatable-wrap">
                <table id="transaksiTable" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $index => $item)
                        <tr>
                            <td class="no-num">{{ $index + 1 }}</td>
                            <td class="total-cell" data-order="{{ $item->total }}">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            <td class="bayar-cell" data-order="{{ $item->bayar }}">Rp {{ number_format($item->bayar, 0, ',', '.') }}</td>
                            <td class="kembalian-cell" data-order="{{ $item->kembalian }}">Rp {{ number_format($item->kembalian, 0, ',', '.') }}</td>
                            <td class="date-cell" data-order="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
    feather.replace();

    $(document).ready(function () {
        $('#transaksiTable').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json'
            },
            order: [[4, 'desc']],
            columnDefs: [
                { orderable: false, targets: [0] },
                { searchable: false, targets: [0] }
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
</script>

</body>
</html>
