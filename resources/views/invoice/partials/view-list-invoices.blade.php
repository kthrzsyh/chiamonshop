<section class="space-y-6">
    <header>
        <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
            <h2 class="text-lg font-semibold text-gray-800">
                List Nota
            </h2>

            <a href="{{ route('invoices.create') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded">
                Buat Nota
            </a>
        </div>

    </header>
    <div>
        <table id="notaTable" class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr class="bg-gray-100 text-left">
                    <th class="whitespace-nowrap px-4 py-2 text-left">Tanggal Nota</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Nama Customer</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Total</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($invoices as $invoice)
                    <tr>
                        <td class="px-4 py-2">{{ $invoice->invoice_date }}</td>
                        <td class="px-4 py-2">{{ $invoice->customer_name }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($invoice->total ?? 0) }}</td>
                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <a href="{{ route('invoices.show', $invoice->id) }}"
                                    class="inline-block bg-gray-500 hover:bg-gray-600 text-white text-xs px-3 py-1 rounded ml-1">
                                    View
                                </a>
                                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-block bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#notaTable').DataTable();
            });
        </script>
    </div>
</section>
