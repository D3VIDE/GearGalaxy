@extends('admin.AdminUi')
@section('content')
<div class="flex-1 ml-64 p-6 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 bg-white p-5 rounded-xl shadow-sm border border-slate-200">
        <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
        <div class="text-slate-500 font-medium">Admin Panel</div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="text-sm font-semibold text-slate-500">Total Produk</div>
            <div class="text-3xl font-extrabold text-slate-800">{{ $totalProducts }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="text-sm font-semibold text-slate-500">Total Kategori</div>
            <div class="text-3xl font-extrabold text-slate-800">{{ $totalCategories }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="text-sm font-semibold text-slate-500">Total Varian</div>
            <div class="text-3xl font-extrabold text-slate-800">{{ $totalVariants }}</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="text-sm font-semibold text-slate-500">Penjualan Hari Ini</div>
            <div class="text-3xl font-extrabold text-slate-800">Rp {{ number_format($salesToday, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-800 mb-3">Harian (7 Hari)</h3>
            <canvas id="dailyChart" height="120"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-800 mb-3">Bulanan (12 Bulan)</h3>
            <canvas id="monthlyChart" height="120"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-800 mb-3">Tahunan (5 Tahun)</h3>
            <canvas id="yearlyChart" height="120"></canvas>
        </div>
    </div>

    <!-- Varian Perlu Restock -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Varian Perlu Restock</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-center">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider">
                         <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Varian</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($lowStockVariants as $variant)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3">
                                <div class="font-semibold text-slate-800">{{ $variant->product->product_name ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-3 text-slate-700">{{ $variant->variant_name }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $stock = $variant->stock ?? 0;
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $stock === 0 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $stock === 0 ? 'Habis' : 'Terbatas (' . $stock . ')' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-700">Rp {{ number_format($variant->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('editVariant', $variant->id) }}"
                                class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded hover:bg-blue-200 transition-colors">
                                    Restock
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-slate-500 py-5">Tidak ada varian yang perlu restock</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailyCtx = document.getElementById('dailyChart').getContext('2d');
    const dailyChart = new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: @json($dailySales->pluck('date')),
            datasets: [{
                label: 'Penjualan Harian',
                data: @json($dailySales->pluck('total')),
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.3,
                fill: true,
                pointRadius: 3,
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
        }
    });

    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: @json($monthlySales->pluck('month')),
            datasets: [{
                label: 'Penjualan Bulanan',
                data: @json($monthlySales->pluck('total')),
                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                borderRadius: 5,
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
        }
    });

    const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
    const yearlyChart = new Chart(yearlyCtx, {
        type: 'bar',
        data: {
            labels: @json($yearlySales->pluck('year')),
            datasets: [{
                label: 'Penjualan Tahunan',
                data: @json($yearlySales->pluck('total')),
                backgroundColor: 'rgba(245, 158, 11, 0.7)',
                borderRadius: 5,
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } },
        }
    });
</script>
@endsection
