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
        Schema::create('lichlamviecs', function (Blueprint $table) {
            $table->unsignedInteger('mabs');
            $table->unsignedInteger('mapk', 20);
            $table->date('ngaylamviec');
            $table->string('calamviec', 20);
            
            // Định nghĩa khóa chính kết hợp
            $table->primary(['mabs', 'mapk', 'ngaylamviec', 'calamviec']);

            // Định nghĩa khóa ngoại
            $table->foreign('mabs')->references('mabs')->on('bac_si')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mapk')->references('mapk')->on('phong_kham')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichlamviecs');
    }
};
