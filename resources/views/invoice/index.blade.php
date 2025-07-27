<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nota') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm"
                role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline ml-1">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full overflow-auto">
                    @include('invoice.partials.view-list-invoices')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
