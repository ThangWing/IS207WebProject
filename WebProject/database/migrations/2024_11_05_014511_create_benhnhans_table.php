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
        Schema::create('benhnhan', function (Blueprint $table) {
            $table->increments('mabn'); // Primary Key, AUTO_INCREMENT
            $table->string('tenbn', 100); // Tên bệnh nhân
            $table->date('ngsinh'); // Ngày sinh
            $table->string('gioitinh', 10); // Giới tính
            $table->integer('sdt')->unique()->index(); // Số điện thoại
            $table->string('diachi', 100); // Địa chỉ
            $table->string('ghichu', 200)->nullable(); // Ghi chú
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benhnhan');
    }
};
