<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 100);
            $table->string('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('order_statuses')->insert([
            [
                'code' => 'pending_payment',
                'name' => 'Menunggu Pembayaran',
                'description' => 'Pesanan dibuat tetapi belum dibayar',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'paid',
                'name' => 'Sudah Dibayar',
                'description' => 'Pembayaran berhasil diterima',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'processing',
                'name' => 'Diproses',
                'description' => 'Pesanan sedang diproses oleh penjual',
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'shipped',
                'name' => 'Dikirim',
                'description' => 'Pesanan sudah dikirim ke pembeli',
                'sort_order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'completed',
                'name' => 'Selesai',
                'description' => 'Pesanan sudah diterima dan selesai',
                'sort_order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'cancelled',
                'name' => 'Dibatalkan',
                'description' => 'Pesanan dibatalkan',
                'sort_order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'expired',
                'name' => 'Kedaluwarsa',
                'description' => 'Pesanan kedaluwarsa karena pembayaran tidak dilakukan',
                'sort_order' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'failed',
                'name' => 'Gagal',
                'description' => 'Pesanan gagal diproses',
                'sort_order' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
