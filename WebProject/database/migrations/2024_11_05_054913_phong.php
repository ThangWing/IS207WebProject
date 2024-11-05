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
        Schema::create('phong', function (Blueprint $table) {
            $table->increments('maphg'); // Primary Key
            $table->string('vitri', 200); 
            $table->string('loaiphong',100);
            $table->unsignedInteger('makhoa');

            $table->foreign('makhoa')->references('makhoa')->on('khoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('phong');
    }
};
