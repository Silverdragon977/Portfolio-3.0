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
        $jsonPath = File::get(database_path('data/mtgCards.json'));
        if (!File::exists($jsonPath)) {
            dd("JSON file not found at: " . $jsonPath);
        }

        $json = file::get($jsonPath);
        $cards = json_decode($json, true);
        if (!cards){
            dd("SON decode failed");
        }
        // Chunking to regulate effiency on server as the database is quite big
        collect($cards)->chunk(500)->each(function ($chunk){
            foreach ($cards as $card) {
                MtgCardsModel::create([
                    'name'                => $card['name'] ?? null,
                    'mana_cost'           => $card['mana_cost'] ?? null,
                    'converted_mana_cost' => $card['converted_mana_cost'] ?? null,
                    'colors'              => $card['colors'] ?? [],
                    'types'               => $card['types'] ?? [],
                    'subtypes'            => $card['subtypes'] ?? [],
                    'description'         => $card['description'] ?? null,
                    'rarity'              => $card['rarity'] ?? null,
                    'purchaseUrls'        => $card['purchaseUrls'] ?? []
                ]);        
            }
        }); // end of chunking


    }
}
