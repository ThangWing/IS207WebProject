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
        Schema::create('bacsi', function (Blueprint $table) {
            $table->increments('mabs'); // Primary Key, tự tăng
            $table->string('tenbs', 100); // Tên bác sĩ
            $table->date('ngsinh'); // Ngày sinh
            $table->string('gioitinh', 10); // Giới tính
            $table->string('diachi', 100); // Địa chỉ
            $table->string('sdt',50)->unique(); // Số điện thoại
            $table->string('email', 100)->unique(); // Email, unique để tránh trùng lặp
            $table->string('hocvi', 50); // Học vị
            $table->string('chucvu', 50); // Chức vụ
            $table->unsignedInteger('makhoa'); // Mã khoa 
            $table->float('hesoluong');
            
            $table->foreign('makhoa')->references('makhoa')->on('khoa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bacsi');
    }
};
