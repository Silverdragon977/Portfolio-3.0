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
            'multiplier' => 1
        ]);
    }

    return response()->json([
        'score' => $save->score,
        'multiplier' => $save->multiplier
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'score' => 'required|integer|min:0',
            'multiplier' => 'required|integer|min:1'
        ]);
        $save = ClickerGame::updateOrCreate(
            // uses the first array to find the record,
            // if it doesn't exist, then it combines both arrays to create a new record
            ['user_id' => auth()->id()],
            [
                'score' => $data['score'],
                'multiplier' => $data['multiplier']
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
