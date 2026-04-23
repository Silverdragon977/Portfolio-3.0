<?php
// File m_t_g_cards_table.php
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
    Schema::create('mtg_cards_table', function (Blueprint $table) {
        $table->id();

        $table->string('name')->nullable()->index();
        $table->string('mana_cost')->nullable();
        $table->float('converted_mana_cost')->nullable();


        $table->json('colors')->nullable();
        $table->json('types')->nullable();
        $table->json('subtypes')->nullable();
        $table->json('supertypes')->nullable();

        $table->text('description')->nullable();
        $table->string('rarity')->nullable();

        $table->json('purchase_urls')->nullable();

        $table->string('thumbnail_url')->nullable();
        $table->string('full_card_image_url')->nullable();

        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mtg_cards_table');
    }
};
