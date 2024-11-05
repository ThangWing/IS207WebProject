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
        //
        Schema::create('thuoc', function (Blueprint $table) {
            $table->increments('mathuoc'); // Primary Key
            $table->string('tenthuoc', 200); // Tên bệnh lý
            $table->int('soluong');
            $table->string('donvi',100);
            $table->decimal('dongia',10,2);
            $table->string('ghichu',200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('thuoc');
    }
};
