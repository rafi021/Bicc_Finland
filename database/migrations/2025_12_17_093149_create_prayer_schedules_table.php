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
        Schema::create('prayer_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->string('fajr')->nullable();
            $table->string('dhuhr')->nullable();
            $table->string('asr')->nullable();
            $table->string('maghrib')->nullable();
            $table->string('isha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_schedules');
    }
};
