<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('order_number', 50)->unique();

            $table->foreignId('user_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('order_status_id')
                ->constrained('order_statuses')
                ->restrictOnDelete();

            $table->decimal('subtotal_amount', 15, 2)->default(0);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->string('payment_status', 50)->default('pending');
            $table->string('shipping_status', 50)->default('not_shipped');

            $table->string('recipient_name', 150);
            $table->string('recipient_phone', 30);
            $table->text('shipping_address');

            $table->string('midtrans_order_id', 100)->nullable()->unique();
            $table->string('midtrans_payment_type', 100)->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();

            $table->index('user_id');
            $table->index('order_status_id');
            $table->index('payment_status');
            $table->index('shipping_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
