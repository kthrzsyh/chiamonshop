{{-- resources/views/penjualan/detail.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Penjualan</h2>
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Laporan Penjualan</h2>
    </x-slot>
    <div class="max-w-5xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Detail Nota #{{ $invoice->nomor_nota }}</h2>
        <p><strong>Customer:</strong> {{ $invoice->customer_name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</p>

        <table class="w-full table-auto mt-4 border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">Barang</th>
                    <th class="p-2 border">Qty</th>
                    <th class="p-2 border">Harga Beli</th>
                    <th class="p-2 border">Harga Jual</th>
                    <th class="p-2 border">Subtotal Beli</th>
                    <th class="p-2 border">Subtotal Jual</th>
                    <th class="p-2 border">Untung</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_beli = 0;
                    $total_jual = 0;
                @endphp
                @foreach ($invoice->items as $item)
                    @php
                        $beli = $item->cost_price ?? 0;
                        $sub_beli = $beli * $item->quantity;
                        $sub_jual = $item->price * $item->quantity;
                        $untung = $sub_jual - $sub_beli;
                        $total_beli += $sub_beli;
                        $total_jual += $sub_jual;
                    @endphp
                    <tr class="text-center border-t">
                        <td class="p-2 border">{{ $item->product->name }}</td>
                        <td class="p-2 border">{{ $item->quantity }}</td>
                        <td class="p-2 border">Rp {{ number_format($beli) }}</td>
                        <td class="p-2 border">Rp {{ number_format($item->price) }}</td>
                        <td class="p-2 border">Rp {{ number_format($sub_beli) }}</td>
                        <td class="p-2 border">Rp {{ number_format($sub_jual) }}</td>
                        <td class="p-2 border text-green-600">Rp {{ number_format($untung) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-100 font-bold">
                <tr>
                    <td colspan="4" class="text-right p-2 border">Total</td>
                    <td class="p-2 border">Rp {{ number_format($total_beli) }}</td>
                    <td class="p-2 border">Rp {{ number_format($total_jual) }}</td>
                    <td class="p-2 border text-green-700">Rp {{ number_format($total_jual - $total_beli) }}</td>
                </tr>
            </tfoot>
        </table>

        <a href="{{ route('report.penjualan') }}" class="inline-block mt-4 text-blue-700 underline">← Kembali ke
            Laporan</a>
    </div>
</x-app-layout>
