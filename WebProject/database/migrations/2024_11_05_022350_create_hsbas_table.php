<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hsba', function (Blueprint $table) {
            $table->increments('maba'); // Primary Key
            $table->unsignedInteger('mabn')->index(); // Foreign Key liên kết với bảng patients
            $table->boolean('nhapvien'); // Trạng thái nhập viện
            $table->string('ghichu', 200)->nullable(); // Ghi chú
            
            // Thiết lập khóa ngoại
            $table->foreign('mabn')->references('mabn')->on('benhnhan')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ctba', function (Blueprint $table){
            $table->unsignedInteger('maba');
            $table->unsignedInteger('mabl');
            $table->primary(['maba', 'mabl']);

            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
            $table->foreign('mabl')->references('mabl')->on('benhly')->onDelete('cascade');
        });

        Schema::create('donthuoc', function (Blueprint $table){
            $table->increments('madt');
            $table->unsignedInteger('maba');
            $table->string('ghichu',200);
            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
        });

        Schema::create('ctdt', function (Blueprint $table){
            $table->unsignedInteger('madt');
            $table->unsignedInteger('mathuoc');
            $table->integer('soluong');
            $table->primary(['madt', 'mathuoc']);

            $table->foreign('madt')->references('madt')->on('donthuoc')->onDelete('cascade');
            $table->foreign('mathuoc')->references('mathuoc')->on('thuoc')->onDelete('cascade');
        });

        Schema::create('ctcls', function (Blueprint $table){
            $table->unsignedInteger('maba');
            $table->unsignedInteger('macls');
            $table->primary(['maba', 'macls']);

            $table->foreign('maba')->references('maba')->on('hsba')->onDelete('cascade');
            $table->foreign('macls')->references('macls')->on('canls')->onDelete('cascade');
        });

        Schema::create('ctnhapvien', function (Blueprint $table){
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

    public function down()
    {
        Schema::dropIfExists('hsbas');
        Schema::dropIfExists('hsbas');
        Schema::dropIfExists('hsbas');
        Schema::dropIfExists('hsbas');
    }
};
