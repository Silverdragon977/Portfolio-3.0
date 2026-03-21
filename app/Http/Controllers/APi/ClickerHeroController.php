<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClickerGame;

class ClickerHeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function load()
    {
    $save = ClickerGame::where('user_id', auth()->id())->first();

    if (!$save) {
        return response()->json([
            'score' => 0,
            'multiplier' => 1,
            'passive_income_level' => 0,
            'prestige_level' => 0,
            'background_color' => 'default',
            'frame_choice' => 'default',
        ]);
    }

    return response()->json([
        'score' => $save->score,
        'multiplier' => $save->multiplier,
        'passive_income_level' => $save->passive_income_level,
        'prestige_level' => $save->prestige_level,
        'background_color' => $save->background_color,
        'frame_choice' => $save->frame_choice,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'score' => 'required|integer|min:0',
            'multiplier' => 'required|integer|min:1',
            'passive_income_level' => 'required|integer|min:0',
            'prestige_level' => 'required|integer|min:0',
            'background_color' => 'required|string',
            'frame_choice' => 'required|string'
        ]);
        $save = ClickerGame::updateOrCreate(
            // uses the first array to find the record,
            // if it doesn't exist, then it combines both arrays to create a new record
            ['user_id' => auth()->id()],
            [
                'score' => $data['score'],
                'multiplier' => $data['multiplier'],
                'passive_income_level' => $data['passive_income_level'],
                'prestige_level' => $data['prestige_level'],
                'background_color' => $data['background_color'],
                'frame_choice' => $data['frame_choice']
            ]
        );
        return response()->json($save);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
