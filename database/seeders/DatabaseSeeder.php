<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\MtgCardSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            BackgroundSeeder::class,
            FrameSeeder::class,
        ]);
        if(file_exists(database_path('seeders/jsonDatasets/mtgCards.json'))) {
            $this->call([
                MtgCardSeeder::class,
            ]);
        }
    }
}
