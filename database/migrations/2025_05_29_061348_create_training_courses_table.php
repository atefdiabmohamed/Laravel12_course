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
        Schema::create('training_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseID')->references('id')->on('courses')->onUpdate('cascade');
            $table->date('start_date')->comment('تاريخ بداية الدورة التدريبية');
            $table->date('end_date')->comment('تارخي تقريبي لنهاية الدورة التدريبية');
            $table->decimal('price', 10, 2);
            $table->string('notes', 400)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_courses');
    }
};
