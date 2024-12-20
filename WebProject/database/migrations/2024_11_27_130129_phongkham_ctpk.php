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
        Schema::create('phongkham', function (Blueprint $table) {
            $table->increments('mapk'); // Primary Key
            $table->string('tenphong', 200);
            $table->string('vitri', 200); 
            $table->unsignedInteger('makhoa');
            $table->foreign('makhoa')->references('makhoa')->on('khoa')->onDelete('cascade');
        });
        //

        Schema::create('ctkhambenh', function (Blueprint $table) {
            $table->increments('makb');
            $table->unsignedInteger('mabn');
            $table->unsignedInteger('mapk');
            $table->index(['mabn', 'mapk']);
            $table->foreign('mabn')->references('mabn')->on('benhnhan')->onDelete('cascade');
            $table->foreign('mapk')->references('mapk')->on('phongkham')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('ctkhambenh');
        Schema::dropIfExists('phongkham');
    }
};
