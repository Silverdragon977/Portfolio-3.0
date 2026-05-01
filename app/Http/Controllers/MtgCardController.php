<?php
// app/Http/Controllers/MtgCardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MtgCardsModel;

class MtgCardController extends Controller
{
    // public Endpoint
    public function index(Request $request){
        $query = MtgCardsModel::query();
        
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
            $query->limit(10)->get()
        );
    }
    public function show($id) {
        $card = MtgCardsModel::findOrFail($id);
        return view('webpages.MTGShowFullCard', compact('card'));
    }
    public function storeImage(Request $request, $id) {
        $data = $request->validate([
            'thumbnail_url' => ['nullable', 'string'],
            'full_card_image_url' => ['nullable', 'string'],
        ]);

        $card = MtgCardsModel::findOrFail($id);

        // ALWAYS update if value exists
        $card->update([
            'thumbnail_url' => $data['thumbnail_url'] ?? $card->thumbnail_url,
            'full_card_image_url' => $data['full_card_image_url'] ?? $card->full_card_image_url,
        ]);

        return response()->json([
            'ok' => true,
            'saved_thumbnail' => $card->thumbnail_url
        ]);
    }

}
