<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Nota') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf

                    {{-- Header Form --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="invoice_date" :value="__('Tanggal Nota')" />
                            <x-text-input id="invoice_date" name="invoice_date" type="date" class="mt-1 block w-full"
                                required />
                        </div>
                        <div>
                            <x-input-label for="customer_name" :value="__('Nama Customer')" />
                            <x-text-input id="customer_name" name="customer_name" type="text"
                                class="mt-1 block w-full" required />
                        </div>
                    </div>

                    {{-- Table Barang --}}
                    <h3 class="text-md font-semibold mt-6 mb-2">Daftar Barang</h3>

                    <div id="items" class="space-y-5">
                        <div class="p-4 border rounded-lg bg-white shadow-sm">
                            <div class="grid grid-cols-1 sm:grid-cols-5 gap-4">
                                <div class="sm:col-span-2">
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Barang</label>
                                    <select name="items[0][product_id]" class="w-full border-gray-300 rounded-lg"
                                        onchange="updatePrice(this, 0)">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                data-price="{{ $product->latestPrice->selling_price ?? 0 }}"
                                                data-cost="{{ $product->latestPrice->cost_price ?? 0 }}">
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Qty</label>
                                    <input type="number" name="items[0][quantity]" value="1" min="1"
                                        class="w-full border-gray-300 rounded-lg" onchange="calculateSubtotal(0)">
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Harga</label>
                                    <input type="number" name="items[0][price]"
                                        class="w-full border-gray-300 bg-gray-100 rounded-lg" readonly>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-700 mb-1 block">Subtotal</label>
                                    <input type="number" name="items[0][subtotal]"
                                        class="w-full border-gray-300 bg-gray-100 rounded-lg" readonly>
                                    <input type="hidden" name="items[0][cost_price]">
                                </div>
                            </div>
                            <div class="mt-4 text-right">
                                <button type="button"
                                    class="px-3 py-1 text-white bg-red-600 hover:bg-red-700 text-sm rounded-lg"
                                    onclick="removeRow(this)">Hapus</button>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addItem()"
                        class="mt-4 mb-4 px-3 py-1 text-white bg-blue-600 hover:bg-blue-700 text-sm rounded-lg">
                        + Tambah Barang
                    </button>

                    {{-- Ongkir, Box, Catatan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <x-input-label for="shipping_cost" :value="__('Ongkir')" />
                            <x-text-input id="shipping_cost" name="shipping_cost" type="number"
                                class="mt-1 block w-full" value="0" />
                        </div>
                        <div>
                            <x-input-label for="box_fee" :value="__('Biaya Box')" />
                            <x-text-input id="box_fee" name="box_fee" type="number" class="mt-1 block w-full"
                                value="0" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="notes" :value="__('Catatan (opsional)')" />
                        <textarea name="notes" id="notes" rows="3" class="w-full border-gray-300 rounded">
                            {{ old('notes') }}
                        </textarea>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <x-primary-button>{{ __('Simpan Nota') }}</x-primary-button>

                        <a href="{{ route('invoices.index') }}"
                            class="inline-block px-4 py-2 text-sm text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        let index = 1;

        function addItem() {
            const container = document.getElementById('items');

            const template = `
        <div class="p-3 border rounded-md bg-gray-50">
            <div class="grid grid-cols-1 sm:grid-cols-5 gap-2">
                <div class="sm:col-span-2">
                    <label class="text-xs font-semibold">Barang</label>
                    <select name="items[${index}][product_id]" class="w-full border-gray-300 rounded" onchange="updatePrice(this, ${index})">
                        <option value="">-- Pilih --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->latestPrice->selling_price ?? 0 }}" data-cost="{{ $product->latestPrice->cost_price ?? 0 }}">
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold">Qty</label>
                    <input type="number" name="items[${index}][quantity]" value="1" min="1"
                        class="w-full border-gray-300 rounded" onchange="calculateSubtotal(${index})">
                </div>
                <div>
                    <label class="text-xs font-semibold">Harga</label>
                    <input type="number" name="items[${index}][price]" class="w-full border-gray-300 bg-gray-100 rounded" readonly>
                </div>
                <div>
                    <label class="text-xs font-semibold">Subtotal</label>
                    <input type="number" name="items[${index}][subtotal]" class="w-full border-gray-300 bg-gray-100 rounded" readonly>
                    <input type="hidden" name="items[${index}][cost_price]">
                </div>
            </div>
            <div class="mt-2 text-right">
                <button type="button" class="text-red-500 text-sm" onclick="removeRow(this)">Hapus</button>
            </div>
        </div>
    `;

            container.insertAdjacentHTML('beforeend', template);
            index++;
        }

        function removeRow(button) {
            button.closest('.p-3.border.rounded-md').remove();
        }

        function updatePrice(selectEl, rowIndex) {
            const selected = selectEl.options[selectEl.selectedIndex];
            const price = selected.dataset.price ?? 0;
            const cost = selected.dataset.cost ?? 0;

            document.querySelector(`input[name="items[${rowIndex}][price]"]`).value = price;
            document.querySelector(`input[name="items[${rowIndex}][cost_price]"]`).value = cost;
            calculateSubtotal(rowIndex);
        }

        function calculateSubtotal(rowIndex) {
            const price = parseFloat(document.querySelector(`input[name="items[${rowIndex}][price]"]`)?.value || 0);
            const qty = parseInt(document.querySelector(`input[name="items[${rowIndex}][quantity]"]`)?.value || 0);
            const subtotalInput = document.querySelector(`input[name="items[${rowIndex}][subtotal]"]`);
            if (subtotalInput) subtotalInput.value = (qty * price).toFixed(0);
        }
    </script>

</x-app-layout>
