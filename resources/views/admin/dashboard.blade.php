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
            <h3 class="text-lg font-bold text-slate-800 mb-5">Penjualan Harian</h3>
            <canvas id="dailyChart" height="150"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-800 mb-5">Penjualan Bulanan</h3>
            <canvas id="monthlyChart" height="150"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-800 mb-5">Penjualan Tahunan</h3>
            <canvas id="yearlyChart" height="150"></canvas>
        </div>
    </div>

    <!-- Varian Perlu Restock -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Varian Yang Perlu Direstock</h3>
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
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');

    const dailyChart = new Chart(dailyCtx, {
        type: 'line',
        data: {
            labels: @json($dailySales->pluck('date')),
            datasets: [{
                label: 'Penjualan Harian',
                data: @json($dailySales->pluck('total')),
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rp ' + new Intl.NumberFormat('id-ID').format(value)
                    }
                }
            }
        }
    });

    const monthlyChart = new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: @json($monthlySales->pluck('month')),
            datasets: [{
                label: 'Penjualan Bulanan',
                data: @json($monthlySales->pluck('total')),
                backgroundColor: 'rgba(16, 185, 129, 0.6)',
                borderColor: 'rgba(5, 150, 105, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rp ' + new Intl.NumberFormat('id-ID').format(value)
                    }
                }
            }
        }
    });

    const yearlyChart = new Chart(yearlyCtx, {
        type: 'bar',
        data: {
            labels: @json($yearlySales->pluck('year')),
            datasets: [{
                label: 'Penjualan Tahunan',
                data: @json($yearlySales->pluck('total')),
                backgroundColor: 'rgba(234, 179, 8, 0.6)',
                borderColor: 'rgba(202, 138, 4, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'Rp ' + new Intl.NumberFormat('id-ID').format(value)
                    }
                }
            }
        }
    });
</script>
@endsection
