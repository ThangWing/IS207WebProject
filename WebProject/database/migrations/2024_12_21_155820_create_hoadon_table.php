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
        Schema::create('hoadon', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoadon')->unique();
            $table->foreignId('hsba_id')->constrained('hsba')->onDelete('cascade');
            $table->decimal('tong_tien', 15, 2);
            $table->text('ghi_chu')->nullable();
            $table->enum('trang_thai', ['chua_thanh_toan', 'da_thanh_toan'])->default('chua_thanh_toan');
            $table->timestamp('thoi_gian_tao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoadon');
    }
};
