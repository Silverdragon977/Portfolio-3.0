
@extends('layouts.defaultLayout')
@section('meta')
    <meta name="api-base" content="{{ url('/api/mtg-cards') }}">
    <meta name="app-base" content="{{ url('/') }}">
@endSection

@section('pageName', 'MTG Search')

@section('header') 

@endsection

        
@section('mainContent')
    <h1>MTG Searcher</h1>
    <form id="search-form">
        <input type="text" id="name" placeholder="Search cards Names">
        <button type="submit">Search</button>
    </form>
    <div id="results"></div>
        {{-- <script>
            window.apiMtgCards = "{{ url('/api/mtg-cards') }}";
        </script>
        <script>
            let cards = [];
            
            // Sleep Helper to not hit the api rate limit
            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            async function fetchCards(name = '') {
                const res = await fetch(`${window.apiMtgCards}?name=${encodeURIComponent(name)}`);
                cards = await res.json();
                renderCards();
            }

            // Updated: accepts full card object
            async function getThumbnail(card) {
            
                // 1. Use DB value first
                if (card.thumbnail_url) {
                    console.log(`DB HIT: ${card.name}`);
                    return {
                    url: card.thumbnail_url,
                    usedApi: false
                    };
                }
            
                // 2. Fallback to API
                console.log(`API CALL: ${card.name}`);
                try {
                    const res = await fetch(`https://api.scryfall.com/cards/named?fuzzy=${encodeURIComponent(card.name)}`);
                    const data = await res.json();
                    
                    let thumb = null;
                    let full = null;

                    if (data.image_uris) {
                        thumb = data.image_uris.small;
                        full = data.image_uris.normal;
                    } else if (data.card_faces) {
                        thumb = data.card_faces[0].image_uris.small;
                        full = data.card_faces[0].image_uris.normal;
                    }

                    if (thumb) {
                        card.thumbnail_url = thumb; // immediate UI cache
                    }

                    // 🔥 3. Write-back ONCE (don’t block UI)
                    if (thumb || full) {
                        fetch(`${window.apiStoreImageBase}/${card.id}/image`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                thumbnail_url: thumb,
                                full_card_image_url: full
                            })
                        })
                        .then(res => {
                            if (!res.ok) {
                                console.error('Save failed (status):', res.status);
                                return;
                            }
                            console.log('Saved:${card.name}');
                            console.log('Used API:', true);
                        })
                        .catch(err => console.error('SAVE FAILED:', err));
                    }
                
                    return {url: thumb, usedApi: true};

                } catch (e) {
                    console.error("Thumbnail error:", card.name);
                }
                return {url: null, usedApi: false};
            }

            // ✅ STEP 1: render immediately (no API calls here)
            function renderCards() {
                const container = document.getElementById('results');
                container.innerHTML = '';
            
                if (cards.length === 0) {
                    container.innerHTML = "<p>No cards found</p>";
                    return;
                }
            
                for (const card of cards) {
                    container.innerHTML += `
                        <div id="card-${card.id}" 
                             style="border:1px solid #ccc; margin:10px; padding:10px; display:flex; gap:15px; align-items:center;">

                            <!-- Placeholder -->
                            <div class="thumb-placeholder" 
                                 style="width:80px; height:110px; background:#eee; display:flex; align-items:center; justify-content:center; font-size:12px;">
                                Loading...
                            </div>
                        
                            <div>
                                <h3>${card.name}</h3>
                                <p>${card.types?.join(', ') ?? ''}</p>
                                <p>${card.colors?.join(', ') ?? ''}</p>
                            
                                <a href="/mtg-searcher/${card.id}">
                                    <button class="btn btn-primary btn-sm">Show Card</button>
                                </a>
                            
                                <button class="btn btn-secondary btn-sm" onclick="addToDeck(${card.id})">
                                    Add to Deck
                                </button>
                            </div>
                        
                        </div>
                    `;
                }
                // Step 2: Load thumbnails AFTER render
                loadThumbnails();
            }
            // ✅ STEP 3: load thumbnails gradually
            async function loadThumbnails() {
                for (const card of cards) {


                    const result = await getThumbnail(card);
                    const thumb = result.url;
                
                    if (thumb) {
                        const el = document.querySelector(`#card-${card.id} .thumb-placeholder`);
                        if (el) {
                            el.innerHTML = `
                                <img src="${thumb}" 
                                     style="width:80px; opacity:0; transition:opacity 0.3s;">
                            `;
                        
                            // fade-in effect
                            const img = el.querySelector('img');
                            setTimeout(() => {
                                img.style.opacity = 1;
                            }, 50);
                        }
                    }
                
                    // 🔥 throttle API calls (IMPORTANT)
                    if (result.usedApi) {
                        await sleep(1000);
                    }
                }
            }

            // Future deck feature
            // async function addToDeck(cardId) { ... }
            

            // Search Form
            document.getElementById('search-form').addEventListener('submit', e => {
                e.preventDefault();
                fetchCards(document.getElementById('name').value);
            });

            // initial load
            fetchCards();
        </script> --}}
@endsection
@section('pageScripts')
    @vite('resources/js/backendScripts/ShowMTGSearchBlade.js')
@endSection