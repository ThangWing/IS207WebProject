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
        Schema::create('phongbenh', function (Blueprint $table) {
            $table->increments('mapb'); // Primary Key
            $table->string('vitri', 200); 
            $table->string('loaidv',100);
            $table->unsignedInteger('makhoa');
            $table->foreign('makhoa')->references('makhoa')->on('khoa')->onDelete('cascade');
        });

        Schema::create('nhapvien', function (Blueprint $table) {
            $table->unsignedInteger('maba');
            $table->unsignedInteger('mapb');
            $table->primary(['maba', 'mapb']);
            $table->date('ngnv')->nullable(); // Ngày nhập viện
            $table->date('ngxv')->nullable(); // Ngày xuất viện
            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
            $table->foreign('mapb')->references('mapb')->on('phongbenh')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('phongbenh');
        Schema::dropIfExists('nhapvien');
        Schema::dropIfExists('khoa');
    }
};
