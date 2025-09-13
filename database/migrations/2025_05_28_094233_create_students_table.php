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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name',225);
            $table->string('phones',100);
            $table->string('address',225);
            $table->string('image',225);
            $table->string('nationalID',30);
            $table->string('notes',225);
            $table->foreignId('country_id')->references('id')->on('countries')->onUpdate('cascade');
            $table->tinyInteger('active')->default(1)->comment('هل الطالب مفعل او معطل');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
