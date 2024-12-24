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
            $table->integer('soluong');
            $table->string('donvi',100);
            $table->decimal('dongia',10,2);
            $table->string('ghichu',200)->nullable();
        });

        Schema::create('donthuoc', function (Blueprint $table) {
            $table->increments('madt');
            $table->unsignedInteger('maba');
            $table->string('ghichu', 200)->nullable();
            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
        });

        Schema::create('ctdt', function (Blueprint $table) {
            $table->unsignedInteger('madt');
            $table->unsignedInteger('mathuoc');
            $table->integer('soluong');
            $table->primary(['madt', 'mathuoc']);
            $table->foreign('madt')->references('madt')->on('donthuoc')->onDelete('cascade');
            $table->foreign('mathuoc')->references('mathuoc')->on('thuoc')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('thuoc');
        Schema::dropIfExists('ctdt');
        Schema::dropIfExists('donthuoc');
    }
};
