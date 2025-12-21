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
        Schema::table('mosque_settings', function (Blueprint $table) {
            $table->string('fajr_azan')->nullable();
            $table->string('fajr_iqamah')->nullable();
            $table->string('dhuhr_azan')->nullable();
            $table->string('dhuhr_iqamah')->nullable();
            $table->string('asr_azan')->nullable();
            $table->string('asr_iqamah')->nullable();
            $table->string('maghrib_azan')->nullable();
            $table->string('maghrib_iqamah')->nullable();
            $table->string('isha_azan')->nullable();
            $table->string('isha_iqamah')->nullable();
            $table->string('jummah_time')->nullable();
            $table->string('jummah_live_link')->nullable();
            $table->string('monthly_schedule_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mosque_settings', function (Blueprint $table) {
            $table->dropColumn([
                'fajr_azan', 'fajr_iqamah',
                'dhuhr_azan', 'dhuhr_iqamah',
                'asr_azan', 'asr_iqamah',
                'maghrib_azan', 'maghrib_iqamah',
                'isha_azan', 'isha_iqamah',
                'jummah_time', 'jummah_live_link', 'monthly_schedule_file'
            ]);
        });
    }
};
