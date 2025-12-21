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
        Schema::create('islamic_classes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category')->default('General'); 
            $table->string('days')->nullable();
            $table->string('time')->nullable(); 
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('class_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('islamic_class_id')->constrained('islamic_classes')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_registrations');
        Schema::dropIfExists('islamic_classes');
    }
};
