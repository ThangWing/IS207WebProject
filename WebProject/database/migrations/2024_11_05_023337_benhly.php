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
        Schema::create('benhly', function (Blueprint $table) {
            $table->increments('mabl'); // Primary Key
            $table->string('tenbl', 200); // Tên bệnh lý
        });

        Schema::create('ctba', function (Blueprint $table) {
            $table->unsignedInteger('maba');
            $table->unsignedInteger('mabl');
            $table->primary(['maba', 'mabl']);
            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
            $table->foreign('mabl')->references('mabl')->on('benhly')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('benhly');
        Schema::dropIfExists('ctba');
    }
};
