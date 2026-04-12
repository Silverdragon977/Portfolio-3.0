<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This will store the all the backgrounds in the database, you can customize the name, rarity, and price as needed.
        $backgrounds = 
        [
            ['name' => 'default', 'rarity' => 'common', 'price' => 0],

            ['name' => 'softSlate', 'rarity' => 'common', 'price' => 50],
            ['name' => 'warmCharcoal', 'rarity' => 'common', 'price' => 50],
            ['name' => 'coolFog', 'rarity' => 'common', 'price' => 50],
            ['name' => 'common', 'rarity' => 'common', 'price' => 50],

            ['name' => 'crimson', 'rarity' => 'rare', 'price' => 1000],
            ['name' => 'gold', 'rarity' => 'rare', 'price' => 1000],
            ['name' => 'oceanTeal', 'rarity' => 'rare', 'price' => 1000],
            ['name' => 'forestNight', 'rarity' => 'rare', 'price' => 1000],
            ['name' => 'royalIndigo', 'rarity' => 'rare', 'price' => 1000],

            ['name' => 'auroraBorealis', 'rarity' => 'epic', 'price' => 20000],
            ['name' => 'sunsetEmber', 'rarity' => 'epic', 'price' => 20000],
            ['name' => 'cosmicAmethyst', 'rarity' => 'epic', 'price' => 20000],

            ['name' => 'celestialDrift', 'rarity' => 'legendary', 'price' => 500000],
            ['name' => 'crimsonMonarch', 'rarity' => 'legendary', 'price' => 500000],
            ['name' => 'arcaneViolet', 'rarity' => 'legendary', 'price' => 500000],
        ];
    }
}
