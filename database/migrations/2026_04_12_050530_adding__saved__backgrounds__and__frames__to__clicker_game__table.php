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
        Schema::table('clicker_games', function (Blueprint $table) {
            $table->json('owned_backgrounds')->nullable();
            $table->json('owned_frames')->nullable();
        });

        Schema::create('backgrounds', function (Blueprint $table) {
            $table->id();

            // unique name (used in your JSON + selection)
            $table->string('name')->unique();

            // rarity system
            $table->enum('rarity', ['common', 'rare', 'epic', 'legendary'])->default('common');

            // cost to purchase
            $table->integer('price')->default(0);

            $table->timestamps();
        });

        Schema::create('frames', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->enum('rarity', ['common', 'rare', 'epic', 'legendary'])->default('common');

            $table->integer('price')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clicker_games', function (Blueprint $table) {
            $table->dropColumn(['owned_backgrounds', 'owned_frames']);
        });
        Schema::dropIfExists('backgrounds');
        Schema::dropIfExists('frames');
    }
};
