<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Penjualan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" class="mb-4 flex gap-4">
                <select name="month" class="border-gray-300 rounded">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                            {{ $month == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
                <select name="year" class="border-gray-300 rounded">
                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}
                        </option>
                    @endfor
                </select>
                <x-primary-button>Tampilkan</x-primary-button>
            </form>

            <div class="mb-4">
                <a href="{{ route('report.penjualan.pdf', ['month' => $month, 'year' => $year]) }}"
                    class="text-sm text-red-700 underline mr-4">Export PDF</a>
                <a href="{{ route('report.penjualan.excel', ['month' => $month, 'year' => $year]) }}"
                    class="text-sm text-green-700 underline">Export Excel</a>
            </div>

            <div class="bg-white p-4 shadow rounded overflow-x-auto">
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-gray-200 text-sm font-semibold">
                        <tr class="text-center">
                            <th class="px-2 py-2">Tanggal</th>
                            <th class="px-2 py-2">Nomor nota</th>
                            <th class="px-2 py-2">Customer</th>
                            <th class="px-2 py-2">Total Beli</th>
                            <th class="px-2 py-2">Total Jual</th>
                            <th class="px-2 py-2">Untung</th>
                            <th class="px-2 py-2">Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($invoices as $invoice)
                            @php
                                $total_beli = $invoice->items->sum(function ($item) {
                                    return $item->quantity * $item->cost_price ?? 0;
                                });

                                $total_jual = $invoice->items->sum(function ($item) {
                                    return $item->quantity * $item->price;
                                });

                                $untung = $total_jual - $total_beli;
                                $produkList = $invoice->items
                                    ->map(fn($item) => $item->product->name ?? '-')
                                    ->implode(', ');
                            @endphp

                            <tr class="border-t text-center">
                                <td class="px-2 py-1">
                                    {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</td>
                                <td class="px-2 py-1">{{ $invoice->nomor_nota }}</td>
                                <td class="px-2 py-1">{{ $invoice->customer_name }}</td>
                                <td class="px-2 py-1 text-right">Rp {{ number_format($total_beli) }}</td>
                                <td class="px-2 py-1 text-right">Rp {{ number_format($total_jual) }}</td>
                                <td class="px-2 py-1 text-green-700 font-semibold text-right">Rp
                                    {{ number_format($untung) }}</td>
                                <td class="px-2 py-1">
                                    <a href="{{ route('report.penjualan.show', $invoice->id) }}"
                                        class="text-blue-600 underline">Lihat</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
