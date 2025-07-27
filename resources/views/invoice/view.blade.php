<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Tombol Download -->
            <div class="flex justify-end">
                <button onclick="downloadNota()" class="px-4 py-2 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                    Download Nota (JPEG)
                </button>
            </div>

            <div id="nota-content" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <!-- Judul -->
                <h1 class="text-3xl font-bold text-center text-red-700">NOTA PENJUALAN</h1>

                <!-- Info Atas -->
                <div class="flex justify-between mt-4">
                    <div>
                        <p class="uppercase font-semibold">Kepada :</p>
                        <p class="text-base">{{ $invoice->customer_name }}</p>
                    </div>
                    <div class="text-right">
                        <p>{{ \Carbon\Carbon::parse($invoice->invoice_date)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>

                <!-- Tabel Barang -->
                <table class="w-full border-collapse mt-4 text-sm">
                    <thead>
                        <tr class="bg-red-700 text-white text-left">
                            <th class="py-2 px-3">Deskripsi Barang</th>
                            <th class="py-2 px-3 text-center">Jumlah</th>
                            <th class="py-2 px-3 text-right">Harga</th>
                            <th class="py-2 px-3 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-red-800">
                        @foreach ($invoice->items as $item)
                            <tr class="border-t border-red-200">
                                <td class="py-2 px-3">{{ $item->product->name }}</td>
                                <td class="py-2 px-3 text-center">{{ $item->quantity }} pcs</td>
                                <td class="py-2 px-3 text-right">Rp {{ number_format($item->price) }}</td>
                                <td class="py-2 px-3 text-right">Rp {{ number_format($item->quantity * $item->price) }}
                                </td>
                            </tr>
                        @endforeach

                        @if ($invoice->box_fee > 0)
                            <tr class="border-t border-red-200">
                                <td class="py-2 px-3">Box</td>
                                <td class="py-2 px-3 text-center">-</td>
                                <td class="py-2 px-3 text-right">Rp {{ number_format($invoice->box_fee) }}</td>
                                <td class="py-2 px-3 text-right">Rp {{ number_format($invoice->box_fee) }}</td>
                            </tr>
                        @endif
                        @if ($invoice->shipping_cost > 0)
                            <tr class="border-t border-red-200">
                                <td class="py-2 px-3">Pengiriman</td>
                                <td class="py-2 px-3 text-center">-</td>
                                <td class="py-2 px-3 text-right">Rp {{ number_format($invoice->shipping_cost) }}</td>
                                <td class="py-2 px-3 text-right">Rp {{ number_format($invoice->shipping_cost) }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Subtotal dan Total -->
                <div class="flex justify-end">
                    <div class="w-1/2 mt-4 space-y-2">
                        <div class="flex justify-between font-semibold">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($invoice->total) }}</span>
                        </div>
                        <div class="bg-red-700 text-white text-lg font-bold px-4 py-2 rounded text-right">
                            Total: Rp {{ number_format($invoice->total) }}
                        </div>
                    </div>
                </div>

                <!-- Info Pembayaran -->
                <div class="mt-6 bg-red-700 text-white p-4 rounded w-fit">
                    <p><strong>Notes:</strong></p>
                    <p>{!! nl2br(e($invoice->notes)) !!}</p>
                </div>

                <!-- Kembali ke daftar (tidak ikut di-export) -->
                <div class="pt-4 hide-on-export">
                    <a href="{{ route('invoices.index') }}" class="text-sm text-red-700 hover:underline">
                        ← Kembali ke daftar nota
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- html2canvas CDN -->
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

    <!-- Script Download -->
    <script>
        function downloadNota() {
            const element = document.getElementById('nota-content');

            // Sembunyikan elemen yang tidak boleh muncul di gambar
            document.querySelectorAll('.hide-on-export').forEach(el => el.style.display = 'none');

            html2canvas(element, {
                scrollY: -window.scrollY,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement('a');
                // Ambil nama dan tanggal dari Blade ke JS
                const customer = @json($invoice->customer_name);
                const date = @json(\Carbon\Carbon::parse($invoice->invoice_date)->format('Ymd'));
                const fileName = `Nota-${customer.replace(/\s+/g, '_')}-${date}.jpeg`;

                link.download = fileName;
                link.href = canvas.toDataURL('image/jpeg');
                link.click();

                // Tampilkan kembali yang disembunyikan
                document.querySelectorAll('.hide-on-export').forEach(el => el.style.display = '');
            });
        }
    </script>
</x-app-layout>
