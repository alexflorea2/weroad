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
        Schema::create('travel_mood', function (Blueprint $table) {
            $table->uuid('moodId');
            $table->foreign('moodId')->references('id')->on('moods')->onDelete('cascade');
            $table->uuid('travelId');
            $table->foreign('travelId')->references('id')->on('travels')->onDelete('cascade');
            $table->integer('weight');
            $table->primary(['travelId', 'moodId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_mood');
    }
};
