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
        DB::table('github_projects')-> insert([
                'title'             => 'Portfolio-3.0',
                'languages'         => 'Blade, PHP, SCSS, Javascript',
                'github_link'       => 'https://github.com/Silverdragon977/Portfolio-3.0',
                'full_description'  => 'This websites source code! This repo consists of mainly my portfolio portion of the website! Go check it out here: https://github.com/Silverdragon977/Portfolio-3.0',
                'short_description' => 'This websites source code!',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);
        // DB::table('github_projects')-> insert([
        //         'title'             => '',
        //         'languages'         => '',
        //         'github_link'       => '',
        //         'full_description'  => '',
        //         'short_description' => '',
        //         'created_at'        => Carbon::now(),
        //         'updated_at'        => Carbon::now(),
        //     ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('github_projects')->whereIn('title', [
            'Portfolio-3.0',
            'API Task Manager',
            'Real-Time Chat App',
        ])->delete();
    }
};
