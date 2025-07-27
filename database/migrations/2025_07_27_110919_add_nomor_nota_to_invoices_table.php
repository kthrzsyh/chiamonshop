<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Tambahkan kolom nullable dulu supaya tidak error saat migrate awal
            $table->string('nomor_nota')->nullable()->after('id');
        });

        // Isi nilai awal untuk existing data
        \App\Models\Invoice::get()->each(function ($invoice, $i) {
            $invoice->nomor_nota = 'INV-' . now()->format('Ymd') . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT);
            $invoice->save();
        });

        // Tambahkan constraint UNIQUE setelah semua data terisi
        Schema::table('invoices', function (Blueprint $table) {
            $table->unique('nomor_nota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropUnique(['nomor_nota']);
            $table->dropColumn('nomor_nota');
        });
    }
};
