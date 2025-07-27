<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow rounded-lg">
                <section>

                    <form method="POST" action="{{ route('products.update', $product->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nama Produk')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                value="{{ old('name', $product->name) }}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Produk')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full"
                                value="{{ old('description', $product->description) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="cost_price" :value="__('Harga Modal')" />
                                <x-text-input id="cost_price" name="cost_price" type="number" class="mt-1 block w-full"
                                    value="{{ old('cost_price', $product->latestPrice->cost_price ?? '') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('cost_price')" />
                            </div>
                            <div>
                                <x-input-label for="selling_price" :value="__('Harga Jual')" />
                                <x-text-input id="selling_price" name="selling_price" type="number"
                                    class="mt-1 block w-full"
                                    value="{{ old('selling_price', $product->latestPrice->selling_price ?? '') }}"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('selling_price')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                            <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:underline">←
                                Kembali</a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
