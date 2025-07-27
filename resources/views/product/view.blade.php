<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-m text-gray-900 leading-tight">
            {{ __('History Harga - ') . $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto text-sm">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Harga Modal</th>
                                <th class="px-4 py-2">Harga Jual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prices as $price)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $price->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($price->cost_price) }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($price->selling_price) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada riwayat
                                        harga.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">
                        ← Kembali ke daftar produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
