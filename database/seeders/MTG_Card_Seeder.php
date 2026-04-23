<?php
// File MTG_Card_Seeder.php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MtgCardsModel;

class MTG_Card_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = File::get(database_path('seeders/jsonDatasets/mtgCards.json'));
        if (!File::exists($jsonPath)) {
            $this->command?->warn('mtgCards.json not found. Skipping MTG seeding.');
            return;
        }

        $json = file::get($jsonPath);
        $cards = json_decode($json, true);
        if (!cards){
            $this->command?->error('Invalid JSON format in mtgCards.json. Skipping.');
            return;
        }

        $this->command?->info('Seeding MTG cards...');

        // Chunking to regulate effiency on server as the database is quite big
        collect($cards)->chunk(500)->each(function ($chunk){
            foreach ($cards as $card) {
                MtgCardsModel::updateOrCreate(
                    ['name' => $card['name']],
                    [
                    'name'                => $card['name'] ?? null,
                    'mana_cost'           => $card['mana_cost'] ?? null,
                    'converted_mana_cost' => $card['converted_mana_cost'] ?? null,
                    'colors'              => $card['colors'] ?? [],
                    'types'               => $card['types'] ?? [],
                    'subtypes'            => $card['subtypes'] ?? [],
                    'description'         => $card['description'] ?? null,
                    'rarity'              => $card['rarity'] ?? null,
                    'purchaseUrls'        => $card['purchaseUrls'] ?? []
                    ]
                );        
            }
        }); // end of chunking
        $this->command?->info('MTG cards seeded successfully.');
        // Make sure to add conditional to DatabaseSeeder so that CI runs despite no Dataset!
    }
}
