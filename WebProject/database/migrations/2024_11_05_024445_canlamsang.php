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
        Schema::create('canls', function (Blueprint $table) {
            $table->increments('macls'); // Primary Key
            $table->string('tencls', 200); // Tên cận lâm sàng
            $table->decimal('gia',10,2);
        });

        Schema::create('phongchucnang', function (Blueprint $table) {
            $table->increments('mapcn'); // Primary Key
            $table->unsignedInteger('macls'); 
            $table->string('vitri',200); 
        });

        Schema::create('ctcls', function (Blueprint $table) {
            $table->unsignedInteger('maba');
            $table->unsignedInteger('mapcn');
            $table->string('ketqua',300);
            $table->primary(['maba', 'mapcn']);

            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
            $table->foreign('mapcn')->references('mapcn')->on('phongchucnang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('canls');
        Schema::dropIfExists('ctcls');
    }
};
