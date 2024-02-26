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
        Schema::create('travels', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('isPublic')->default(false);
            $table->string('slug');
            $table->string('title');
            $table->text('description');
            $table->integer('numberOfDays');
            $table->json('moods');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};