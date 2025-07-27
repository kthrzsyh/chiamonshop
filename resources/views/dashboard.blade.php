<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded shadow text-center">
                    <p class="text-sm text-gray-500 mb-1">Pesanan Bulan Ini</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $ordersThisMonth }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <p class="text-sm text-gray-500 mb-1">Omset Bulan Ini</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($omsetThisMonth) }}</p>
                </div>
                <div class="bg-white p-6 rounded shadow text-center">
                    <p class="text-sm text-gray-500 mb-1">Keuntungan Bulan Ini</p>
                    <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($profitThisMonth) }}</p>
                </div>
            </div>

            {{-- Grafik Penjualan --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Grafik Penjualan ({{ now()->year }})</h3>
                <canvas id="salesChart" height="80"></canvas>
            </div>

            {{-- Produk Terlaris --}}
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-2">Produk Terlaris Bulan Ini</h3>
                @if ($topProduct)
                    <p class="text-gray-800 text-lg">
                        {{ $topProduct->product->name }} <br>
                        <span class="text-sm text-gray-500">Total Terjual: {{ $topProduct->total_quantity }} pcs</span>
                    </p>
                @else
                    <p class="text-gray-500">Belum ada data.</p>
                @endif
            </div>

        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Omset Penjualan',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
