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
        Schema::create('khoa', function (Blueprint $table) {
            $table->increments('makhoa'); // Primary Key
            $table->string('tenkhoa', 200); // Tên khoa
            $table->unsignedInteger('trgkhoa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('khoa');
    }
};
