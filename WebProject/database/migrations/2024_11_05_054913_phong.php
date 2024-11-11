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
        Schema::create('khoa', function (Blueprint $table) {
            $table->increments('makhoa'); // Primary Key
            $table->string('tenkhoa', 200); // Tên khoa
            $table->unsignedInteger('trgkhoa')->nullable();
        });

        //
        Schema::create('phong', function (Blueprint $table) {
            $table->increments('maphg'); // Primary Key
            $table->string('vitri', 200); 
            $table->string('loaiphong',100);
            $table->unsignedInteger('makhoa');

            $table->foreign('makhoa')->references('makhoa')->on('khoa')->onDelete('cascade');
        });

        Schema::create('ctnhapvien', function (Blueprint $table) {
            $table->unsignedInteger('maba');
            $table->unsignedInteger('maphg');
            $table->primary(['maba', 'maphg']);
            $table->date('ngnv')->nullable(); // Ngày nhập viện
            $table->date('ngxv')->nullable(); // Ngày xuất viện
            $table->string('loaidv');
            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
            $table->foreign('maphg')->references('maphg')->on('phong')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('phong');
        Schema::dropIfExists('ctnhapvien');
        Schema::dropIfExists('khoa');
    }
};
