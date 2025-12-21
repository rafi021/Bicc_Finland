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
        Schema::create('mosque_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_logo')->nullable(); 
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('video_thumbnail')->nullable(); 
            $table->string('video_id')->nullable();
            $table->decimal('donation_raised', 15, 2)->default(0);
            $table->decimal('donation_goal', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mosque_settings');
    }
};
