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
        Schema::create('designations', function (Blueprint $table) {
            $table->id(); // Tạo cột id với kiểu AUTO_INCREMENT và PRIMARY KEY
            $table->string('name', 255); // Tạo cột name với kiểu NVARCHAR(255)
            $table->unsignedBigInteger('department_id'); // Tạo cột department_id với kiểu INT không âm
            $table->timestamps(); // Tạo cột created_at và updated_at
        
            // Thêm ràng buộc khóa ngoại
            $table->foreign('department_id')->references('id')->on('departments');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
