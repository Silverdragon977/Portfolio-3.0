<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MtgCardController extends Controller
{
    // public Endpoint
    public function index(Request $request){
        $query = MTGCardsModel::query();
        
        // Basic Query
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        if ($request->filled('type')) {
            $query->whereJsonContains('types', $request->type);
        }

        if ($request->filled('color')) {
            $query->whereJsonContains('colors', $request->color);
        }

        return response()->json(
            $query->limit(50)->get()
        );
    }
}
