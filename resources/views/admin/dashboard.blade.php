@extends('admin.AdminUi')
@section('content')
    <!-- Main Content -->
    <div class="flex-1 ml-64 p-6 min-h-screen">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 bg-white p-5 rounded-xl shadow-sm border border-slate-200">
            <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text" id="globalSearch" placeholder="Cari produk, kategori, varian..." 
                           class="pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 w-80">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">🔍</span>
                </div>
                <div class="text-slate-500 font-medium">Admin Panel</div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:-translate-y-1 hover:shadow-md transition-transform">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Produk</div>
                </div>
                <div class="text-3xl font-extrabold text-slate-800 mb-2" id="totalProducts">12</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:-translate-y-1 hover:shadow-md transition-transform">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Kategori Aktif</div>
                </div>
                <div class="text-3xl font-extrabold text-slate-800 mb-2">6</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:-translate-y-1 hover:shadow-md transition-transform">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Varian</div>
                </div>
                <div class="text-3xl font-extrabold text-slate-800 mb-2" id="totalVariants">89</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:-translate-y-1 hover:shadow-md transition-transform">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Penjualan Hari Ini</div>
                </div>
                <div class="text-3xl font-extrabold text-slate-800 mb-2">Rp 100000000</div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">
            <!-- Chart Container -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 lg:col-span-2">
                <h3 class="text-lg font-bold text-slate-800 mb-5">Grafik Penjualan (30 Hari Terakhir)</h3>
                <div class="h-72 bg-gradient-to-br from-blue-50 to-sky-100 rounded-lg flex items-center justify-center text-blue-800 font-semibold border-2 border-dashed border-sky-300">
                    Visualisasi data penjualan harian, bulanan, dan tahunan
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <h3 class="text-lg font-bold text-slate-800 mb-5">Aksi Cepat</h3>
                
                <a href="#" class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-lg mb-3 hover:bg-slate-100 hover:border-blue-400 hover:translate-x-1 transition-all no-underline">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-lg">+</div>
                    <div>
                        <div class="font-semibold text-slate-800">Tambah Produk Baru</div>
                        <div class="text-xs text-slate-500">Buat produk dengan varian</div>
                    </div>
                </a>

                <a href="#" class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-lg mb-3 hover:bg-slate-100 hover:border-blue-400 hover:translate-x-1 transition-all no-underline">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-lg">Kategori</div>
                    <div>
                        <div class="font-semibold text-slate-800">Buat Kategori</div>
                        <div class="text-xs text-slate-500">Organisir produk Anda</div>
                    </div>
                </a>

                <a href="#" class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-lg mb-3 hover:bg-slate-100 hover:border-blue-400 hover:translate-x-1 transition-all no-underline">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-lg">Varian</div>
                    <div>
                        <div class="font-semibold text-slate-800">Kelola Varian</div>
                        <div class="text-xs text-slate-500">Atur warna, ukuran, dll</div>
                    </div>
                </a>

                <a href="#" class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-100 hover:border-blue-400 hover:translate-x-1 transition-all no-underline">
                    <div class="w-10 h-10 rounded-lg bg-white shadow-sm flex items-center justify-center text-lg">Laporan</div>
                    <div>
                        <div class="font-semibold text-slate-800">Lihat Laporan</div>
                        <div class="text-xs text-slate-500">Analisis penjualan</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-5">
            <div class="flex justify-between items-center mb-4">
                <div class="font-semibold text-slate-800">Filter Produk</div>
                <div class="text-sm text-slate-500" id="resultCount">Menampilkan 12 produk</div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Kategori</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="fashion">Fashion</option>
                        <option value="makanan">Makanan & Minuman</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="rumah">Rumah Tangga</option>
                        <option value="otomotif">Otomotif</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Rentang Harga</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Harga</option>
                        <option value="0-50000">Di bawah Rp 50.000</option>
                        <option value="50000-100000">Rp 50.000 - Rp 100.000</option>
                        <option value="100000-500000">Rp 100.000 - Rp 500.000</option>
                        <option value="500000-999999">Di atas Rp 500.000</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Stok</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="terbatas">Stok Terbatas</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jumlah Varian</label>
                    <select class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        <option value="">Semua Varian</option>
                        <option value="1-5">1-5 varian</option>
                        <option value="6-10">6-10 varian</option>
                        <option value="11-99">Lebih dari 10 varian</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-2 mt-4">
                <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors">
                    Terapkan Filter
                </button>
                <button class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition-colors border border-slate-300">
                    Reset
                </button>
            </div>

            <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-slate-200 hidden" id="activeFilters"></div>
        </div>

        <!-- Products Table -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Daftar Produk</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider">
                            <th class="px-4 py-3 text-left">Produk</th>
                            <th class="px-4 py-3 text-left">Kategori</th>
                            <th class="px-4 py-3 text-left">Varian</th>
                            <th class="px-4 py-3 text-left">Harga</th>
                            <th class="px-4 py-3 text-left">Status Stok</th>
                            <th class="px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100" id="productsTableBody">
                        <!-- Product rows will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="text-center py-10 hidden" id="emptyState">
                <div class="text-5xl mb-4">🔍</div>
                <div class="font-semibold text-slate-700 mb-2">Tidak ada produk ditemukan</div>
                <div class="text-slate-500">Coba ubah filter atau kata kunci pencarian</div>
            </div>
        </div>
    </div>

    <script>
        // Sample product data
        const products = [
            {
                id: 1,
                name: "Shock Breaker Premium",
                sku: "SB-001",
                category: "otomotif",
                variants: 3,
                price: 250000,
                stock: "tersedia",
                variants: [
                    { color: "Merah", price: 250000, stock: 5 },
                    { color: "Kuning", price: 255000, stock: 8 },
                    { color: "Biru", price: 260000, stock: 3 }
                ]
            },
            {
                id: 2,
                name: "Ban Tubeless Racing",
                sku: "BT-205",
                category: "otomotif",
                variants: 2,
                price: 350000,
                stock: "terbatas",
                variants: [
                    { size: "80/90", price: 350000, stock: 2 },
                    { size: "90/90", price: 370000, stock: 1 }
                ]
            },
            {
                id: 3,
                name: "Kampas Rem Depan",
                sku: "KR-112",
                category: "otomotif",
                variants: 1,
                price: 120000,
                stock: "tersedia",
                variants: [
                    { type: "Standard", price: 120000, stock: 15 }
                ]
            }
        ];

        // Render products table
        function renderProducts() {
            const tableBody = document.getElementById('productsTableBody');
            tableBody.innerHTML = '';
            
            products.forEach(product => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-slate-50';
                row.innerHTML = `
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-sm">
                                ${product.name.charAt(0)}
                            </div>
                            <div>
                                <div class="font-semibold text-slate-800">${product.name}</div>
                                <div class="text-xs text-slate-500">${product.sku}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold ${
                            product.category === 'otomotif' ? 'bg-blue-100 text-blue-800' : 
                            product.category === 'elektronik' ? 'bg-indigo-100 text-indigo-800' :
                            product.category === 'fashion' ? 'bg-amber-100 text-amber-800' :
                            product.category === 'makanan' ? 'bg-green-100 text-green-800' :
                            product.category === 'olahraga' ? 'bg-purple-100 text-purple-800' :
                            'bg-red-100 text-red-800'
                        }">
                            ${product.category.charAt(0).toUpperCase() + product.category.slice(1)}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold">
                            ${product.variants.length} varian
                        </span>
                    </td>
                    <td class="px-4 py-3 text-slate-700">Rp ${product.price.toLocaleString('id-ID')}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold ${
                            product.stock === 'tersedia' ? 'bg-green-100 text-green-800' :
                            product.stock === 'terbatas' ? 'bg-yellow-100 text-yellow-800' :
                            'bg-red-100 text-red-800'
                        }">
                            ${product.stock === 'tersedia' ? 'Tersedia' : 
                              product.stock === 'terbatas' ? 'Terbatas' : 'Habis'}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <button class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-semibold rounded hover:bg-amber-200 transition-colors">
                                Edit
                            </button>
                            <button class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded hover:bg-red-200 transition-colors">
                                Hapus
                            </button>
                        </div>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            renderProducts();
        });
    </script>
@endsection