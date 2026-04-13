<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // This will store the all the frames in the database, you can customize the name, rarity, and price as needed.
        $frames = 
        [
            ['name' => 'default', 'rarity' => 'common', 'price' => 0],
            ['name' => 'common', 'rarity' => 'rare', 'price' => 500],
            ['name' => 'neon', 'rarity' => 'epic', 'price' => 10000],
        ];
    }
}
