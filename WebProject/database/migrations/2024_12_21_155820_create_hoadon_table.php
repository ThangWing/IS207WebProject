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
            $table->increments('mahd');
            $table->unsignedInteger('maba');
            $table->decimal('tong_tien', 15, 2);
            $table->string('ghi_chu',200)->nullable();
            $table->enum('trang_thai', ['chua_thanh_toan', 'da_thanh_toan'])->default('chua_thanh_toan');
            $table->timestamp('thoi_gian_tao')->nullable();
            $table->timestamps();
            $table->foreign('maba')->references('maba')->on('hsba')
                ->onDelete('cascade')->onUpdate('cascade');
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
