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

        Schema::create('bhyt', function (Blueprint $table) {
            $table->increments('bhytid');
            $table->unsignedInteger('mabn'); 
            $table->string('ma_the', 20)->unique();
            $table->date('ngay_hieu_luc'); 
            $table->date('ngay_het_han'); 
            $table->string('noi_dang_ky', 100)->nullable();
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('mabn')->references('mabn')->on('benhnhan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benhnhan');
        Schema::dropIfExists('bhyt');
    }
};
