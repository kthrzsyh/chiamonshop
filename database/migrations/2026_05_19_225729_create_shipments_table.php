<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('courier_name', 100);
            $table->string('tracking_number', 150)->nullable();

            $table->string('shipping_proof')->nullable();
            $table->text('shipping_note')->nullable();

            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('received_at')->nullable();

            $table->timestamps();

            $table->index('order_id');
            $table->index('courier_name');
            $table->index('tracking_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
