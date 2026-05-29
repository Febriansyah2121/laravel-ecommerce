<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom category_id dan hapus kolom category lama
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom category jika ada
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }
            
            // Tambah kolom category_id
            $table->foreignId('category_id')->nullable()->after('id')
                  ->constrained('categories')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category')->nullable();
        });
    }
};