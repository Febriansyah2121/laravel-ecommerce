<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus foreign key jika ada
        try {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropForeign(['product_id']);
            });
        } catch (\Exception $e) {}
        
        // Hapus kolom yang tidak diperlukan
        try {
            Schema::table('orders', function (Blueprint $table) {
                if (Schema::hasColumn('orders', 'user_id')) $table->dropColumn('user_id');
                if (Schema::hasColumn('orders', 'product_id')) $table->dropColumn('product_id');
                if (Schema::hasColumn('orders', 'quantity')) $table->dropColumn('quantity');
                if (Schema::hasColumn('orders', 'total')) $table->dropColumn('total');
            });
        } catch (\Exception $e) {}
        
        // Tambah kolom baru
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'customer_name')) {
                $table->string('customer_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'customer_email')) {
                $table->string('customer_email')->nullable();
            }
            if (!Schema::hasColumn('orders', 'customer_phone')) {
                $table->string('customer_phone')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_address')) {
                $table->text('shipping_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'total_amount')) {
                $table->decimal('total_amount', 12, 2)->default(0);
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->default('cod');
            }
            if (!Schema::hasColumn('orders', 'items')) {
                $table->json('items')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Rollback
    }
};