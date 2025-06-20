<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen Produk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 260px;
            background: #1e293b;
            padding: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            padding: 24px 20px;
            border-bottom: 1px solid #334155;
        }

        .logo h2 {
            color: #f1f5f9;
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-section {
            padding: 16px 0;
        }

        .nav-item {
            padding: 12px 20px;
            margin: 2px 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-item:hover {
            background: #334155;
            color: #e2e8f0;
        }

        .nav-item.active {
            background: #3b82f6;
            color: white;
            font-weight: 600;
        }

        .nav-item i {
            width: 18px;
            font-size: 16px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 24px;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            background: white;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .header h1 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 16px 10px 40px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
            width: 300px;
        }

        .search-box input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-box::before {
            content: '🔍';
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-title {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1;
        }

        .content-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 32px;
        }

        .chart-container, .quick-actions {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0369a1;
            font-size: 16px;
            font-weight: 600;
            border: 2px dashed #38bdf8;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #374151;
            font-weight: 500;
        }

        .quick-action-btn:hover {
            background: #f1f5f9;
            border-color: #3b82f6;
            transform: translateX(4px);
        }

        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .recent-products {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        /* Filter Section Styles */
        .filter-section {
            background: white;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .filter-controls {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .filter-select, .filter-input {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
            background: white;
        }

        .filter-select:focus, .filter-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn.primary {
            background: #3b82f6;
            color: white;
        }

        .filter-btn.primary:hover {
            background: #2563eb;
        }

        .filter-btn.secondary {
            background: #f1f5f9;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .filter-btn.secondary:hover {
            background: #e2e8f0;
        }

        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .filter-tag {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filter-tag .remove {
            cursor: pointer;
            font-weight: 700;
            color: #dc2626;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .products-table th,
        .products-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
        }

        .products-table th {
            background: #f8fafc;
            font-weight: 600;
            color: #374151;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .products-table tr:hover {
            background: #f9fafb;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .product-details h4 {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .product-sku {
            font-size: 12px;
            color: #6b7280;
        }

        .table-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .action-btn.edit {
            background: #fef3c7;
            color: #92400e;
        }

        .action-btn.edit:hover {
            background: #fde68a;
        }

        .action-btn.delete {
            background: #fecaca;
            color: #991b1b;
        }

        .action-btn.delete:hover {
            background: #fca5a5;
        }

        .variant-count {
            background: #e0f2fe;
            color: #0c4a6e;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .category-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .category-badge.elektronik { background: #dbeafe; color: #1e40af; }
        .category-badge.fashion { background: #fef3c7; color: #92400e; }
        .category-badge.makanan { background: #dcfce7; color: #166534; }
        .category-badge.olahraga { background: #f3e8ff; color: #7c3aed; }
        .category-badge.rumah { background: #fed7d7; color: #c53030; }
        .category-badge.otomotif { background: #e0f2fe; color: #0c4a6e; }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }
            
            .main-content {
                margin-left: 220px;
            }
            
            .content-section {
                grid-template-columns: 1fr;
            }

            .filter-controls {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                gap: 16px;
                align-items: stretch;
            }
            
            .search-box input {
                width: 100%;
            }

            .filter-controls {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                justify-content: stretch;
            }

            .filter-btn {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h2>Galaxy Sparepart</h2>
        </div>
        
        <div class="nav-section">
            <div class="nav-item active">
                <span>Dashboard</span>
            </div>
            
            <div class="nav-item">
                <span>Kelola Produk</span>
            </div>
            
            <div class="nav-item">
                <span>Kategori Produk</span>
            </div>
            
            <div class="nav-item">
                <span>Varian Produk</span>
            </div>
            
            <div class="nav-item">
                <span>Atribut Varian</span>
            </div>
            
            <div class="nav-item">
                <span>Laporan penjualan</span>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" id="globalSearch" placeholder="Cari produk, kategori, varian...">
                </div>
                <div style="color: #6b7280; font-weight: 500;">Admin Panel</div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Produk</div>
                </div>
                <div class="stat-value" id="totalProducts">12</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Kategori Aktif</div>
                </div>
                <div class="stat-value">6</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Total Varian</div>
                </div>
                <div class="stat-value" id="totalVariants">89</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-title">Penjualan Hari Ini</div>
                </div>
                <div class="stat-value">Rp 100000000</div>
            </div>
        </div>

        <div class="content-section">
            <div class="chart-container">
                <div class="section-title">Grafik Penjualan (30 Hari Terakhir)</div>
                <div class="chart-placeholder">
                    Visualisasi data penjualan harian, bulanan, dan tahunan
                </div>
            </div>

            <div class="quick-actions">
                <div class="section-title">Aksi Cepat</div>
                
                <div class="quick-action-btn">
                    <div class="quick-action-icon">+</div>
                    <div>
                        <div style="font-weight: 600;">Tambah Produk Baru</div>
                        <div style="font-size: 12px; color: #6b7280;">Buat produk dengan varian</div>
                    </div>
                </div>

                <div class="quick-action-btn">
                    <div class="quick-action-icon">Kategori</div>
                    <div>
                        <div style="font-weight: 600;">Buat Kategori</div>
                        <div style="font-size: 12px; color: #6b7280;">Organisir produk Anda</div>
                    </div>
                </div>

                <div class="quick-action-btn">
                    <div class="quick-action-icon">Varian</div>
                    <div>
                        <div style="font-weight: 600;">Kelola Varian</div>
                        <div style="font-size: 12px; color: #6b7280;">Atur warna, ukuran, dll</div>
                    </div>
                </div>

                <div class="quick-action-btn">
                    <div class="quick-action-icon">Laporan</div>
                    <div>
                        <div style="font-weight: 600;">Lihat Laporan</div>
                        <div style="font-size: 12px; color: #6b7280;">Analisis penjualan</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-header">
                <div style="font-size: 16px; font-weight: 600; color: #1f2937;">Filter Produk</div>
                <div style="font-size: 14px; color: #6b7280;" id="resultCount">Menampilkan 12 produk</div>
            </div>
            
            <div class="filter-controls">
                <div class="filter-group">
                    <label class="filter-label">Kategori</label>
                    <select class="filter-select" id="categoryFilter">
                        <option value="">Semua Kategori</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="fashion">Fashion</option>
                        <option value="makanan">Makanan & Minuman</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="rumah">Rumah Tangga</option>
                        <option value="otomotif">Otomotif</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Rentang Harga</label>
                    <select class="filter-select" id="priceFilter">
                        <option value="">Semua Harga</option>
                        <option value="0-50000">Di bawah Rp 50.000</option>
                        <option value="50000-100000">Rp 50.000 - Rp 100.000</option>
                        <option value="100000-500000">Rp 100.000 - Rp 500.000</option>
                        <option value="500000-999999">Di atas Rp 500.000</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Status Stok</label>
                    <select class="filter-select" id="stockFilter">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="terbatas">Stok Terbatas</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Jumlah Varian</label>
                    <select class="filter-select" id="variantFilter">
                        <option value="">Semua Varian</option>
                        <option value="1-5">1-5 varian</option>
                        <option value="6-10">6-10 varian</option>
                        <option value="11-99">Lebih dari 10 varian</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button class="filter-btn primary" onclick="applyFilters()">Terapkan Filter</button>
                    <button class="filter-btn secondary" onclick="resetFilters()">Reset</button>
                </div>
            </div>

            <div class="active-filters" id="activeFilters" style="display: none;"></div>
        </div>

        <div class="recent-products">
            <div class="section-title">Daftar Produk</div>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Varian</th>
                        <th>Harga</th>
                        <th>Status Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    <!-- Nanti produknya silahkan di atur di java scripnya wkwkwkw -->
                </tbody>
            </table>
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-state-icon">gambar search</div>
                <div style="font-weight: 600; margin-bottom: 8px;">Tidak ada produk ditemukan</div>
                <div>Coba ubah filter atau kata kunci pencarian</div>
            </div>
        </div>
    </div>
</body>
</html>