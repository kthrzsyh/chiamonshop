<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Buat Produk') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Tuliskan nama, harga & deskripsi produk!') }}
        </p>
    </header>

    <form method="post" action="{{ route('products.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="nama" :value="__('Nama Produk')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="description " :value="__('Deskripsi Produk')" />
            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="description" />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div class="row">
            <h2>Harga</h2>
            <div class="col-md-6">
                <x-input-label for="cost_price" :value="__('Harga Beli')" />
                <x-text-input id="cost_price" name="cost_price" type="number" class="mt-1 block w-full" required
                    autocomplete="cost_price" />
                <x-input-error class="mt-2" :messages="$errors->get('cost_price')" />
            </div>
            <div class="col-md-6">
                <x-input-label for="selling_price" :value="__('Harga Jual')" />
                <x-text-input id="selling_price" name="selling_price" type="number" class="mt-1 block w-full" required
                    autocomplete="selling_price" />
                <x-input-error class="mt-2" :messages="$errors->get('selling_price')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'products-store')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">{{ __('Produk berhasil di simpan') }}</p>
            @endif
        </div>
    </form>
</section>
