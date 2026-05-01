
@extends('layouts.defaultLayout')
@section('pageName', 'MTG Search')
    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>Full Card Information</h1><br><br><br>

            <h1>{{ $card->name }}</h1>
            @if ($card->full_card_image_url)
                <img
                    id="card-image"
                    src="{{ $card->full_card_image_url }}"
                    class="img-fluid rounded shadow mb-3"
                    style="max-width:300px;"
                >
            @else
                <img
                    id="card-image"
                    src="{{ asset('images/mtg-placeholder.png') }}"
                    class="img-fluid rounded shadow mb-3"
                    style="max-width:300px;"
                >
            @endif
            
            <p><strong>Color Mana: </strong>
                 {{ implode(', ', $card->colors ?? []) }}
            </p>
            <p><strong>Mana Cost:</strong> {{ $card->mana_cost }}</p>
            <p><strong>Total Mana Cost:</strong> {{ $card->converted_mana_cost }}</p>

            <p><strong>Rarity:</strong> {{ $card->rarity ?? 'Common' }}</p><br>
            <hr>
            <p><strong>Types:</strong>
                {{ implode(', ', $card->types ?? []) }}
                <br>
                {{ implode(', ', $card->subtypes ?? [] ) }}
                <br>
                {{ implode(', ', $card->supertypes ?? [] ) }}
            </p>
            <p><strong>Description:</strong></p>
            <p>{{ $card->description }}</p><br><br>


            <p><strong>Purchse Here</strong>
            <div class="d-flex flex-wrap gap-4">
                @foreach ($card->purchase_urls ?? [] as $site => $url)
                    <a href="{{ $url }}" class="btn btn-outline-success btn-sm"> {{ ucfirst($site) }} </a>
                @endforeach
            </div>
            
           <script>
                async function loadFullImage(card) {
                
                    //  If DB already has it → do nothing
                    if (card.full_card_image_url) {
                        console.log(`DB HIT (FULL): ${card.name}`);
                        return;
                    }
                
                    console.log(`API CALL (FULL): ${card.name}`);
                
                    try {
                        const res = await fetch(`https://api.scryfall.com/cards/named?fuzzy=${encodeURIComponent(card.name)}`);
                        const data = await res.json();
                    
                        let full = null;
                    
                        if (data.image_uris) {
                            full = data.image_uris.normal;
                        } else if (data.card_faces) {
                            full = data.card_faces[0].image_uris.normal;
                        }
                    
                        if (full) {
                            //  Update UI immediately
                            document.getElementById('card-image').src = full;
                        
                            //  Update local object (optional but clean)
                            card.full_card_image_url = full;
                        
                            //  Save to DB (non-blocking)
                            fetch(`/api/mtg-cards/${card.id}/image`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    full_card_image_url: full
                                })
                            })
                            .then(res => {
                                if (!res.ok) {
                                    console.error('Save FULL failed:', res.status);
                                    return;
                                }
                                console.log(`Saved FULL: ${card.name}`);
                            })
                            .catch(err => console.error('SAVE FULL FAILED:', err));
                        }
                    
                    } catch (e) {
                        console.error("Full image error:", card.name);
                    }
                }

                // 🔥 Pass Laravel card to JS
                loadFullImage(@json($card));
            </script>

    @endsection

