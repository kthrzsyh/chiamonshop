<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('List Produk') }}
        </h2>
    </header>
    <div>
        <table id="productTable" class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr class="bg-gray-100 text-left">
                    <th class="whitespace-nowrap px-4 py-2 text-left">Nama</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Harga Jual</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Harga Modal</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Deskripsi</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Updated At</th>
                    <th class="whitespace-nowrap px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($products as $product)
                    <tr>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($product->latestPrice->selling_price ?? 0) }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($product->latestPrice->cost_price ?? 0) }}</td>
                        <td class="px-4 py-2">{{ $product->description }}</td>
                        <td class="px-4 py-2">{{ $product->latestPrice->updated_at }}</td>
                        <td class="px-4 py-2">
                            <div class="flex gap-2">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                    Update
                                </a>
                                <a href="{{ route('products.history', $product->id) }}"
                                    class="inline-block bg-gray-500 hover:bg-gray-600 text-white text-xs px-3 py-1 rounded ml-1">
                                    View
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
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
                $('#productTable').DataTable();
            });
        </script>
    </div>
</section>
