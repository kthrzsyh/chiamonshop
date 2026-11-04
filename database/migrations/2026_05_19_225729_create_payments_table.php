<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('midtrans_transaction_id', 150)->nullable();
            $table->string('midtrans_order_id', 100)->nullable();
            $table->string('payment_type', 100)->nullable();

            $table->string('transaction_status', 100)->nullable();
            $table->string('fraud_status', 100)->nullable();

            $table->decimal('gross_amount', 15, 2)->default(0);
            $table->string('currency', 10)->default('IDR');

            $table->timestamp('transaction_time')->nullable();
            $table->timestamp('settlement_time')->nullable();
            $table->timestamp('expiry_time')->nullable();

            $table->json('payload_json')->nullable();

            $table->timestamps();

            $table->index('order_id');
            $table->index('midtrans_transaction_id');
            $table->index('midtrans_order_id');
            $table->index('transaction_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
