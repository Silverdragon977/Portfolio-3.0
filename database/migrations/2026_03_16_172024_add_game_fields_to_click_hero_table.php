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
            $table->integer('passive_income_level')->default(0);
            $table->integer('prestige_level')->default(0);
            $table->string('background_color')->default('default');
            $table->string('frame_choice')->default('default');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clicker_games', function (Blueprint $table) {

            $table->dropColumn([
                'passive_income_level',
                'prestige_level',
                'background_color',
                'frame_choice',
            ]);
        });
    }
};
