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
            $table->boolean('nhapvien')->default(false); // Trạng thái nhập viện
            $table->string('chieucao', 200)->nullable(); // Ghi chú
            $table->string('cannang', 200)->nullable(); // Ghi chú
            $table->string('huyetap', 200)->nullable(); // Ghi chú
            $table->string('mach', 200)->nullable(); // Ghi chú
            $table->string('trieuchung', 200)->nullable(); // Ghi chú
            $table->string('ghichu', 200)->nullable(); // Ghi chú
            // Thiết lập khóa ngoại
            $table->foreign('mabn')->references('mabn')->on('benhnhan')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hsba');
    }
};
