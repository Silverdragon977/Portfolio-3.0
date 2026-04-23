@extends('layouts.defaultLayout')

    @section('header')
    @endsection
        
    @section('mainContent')
        <h1>MTG Searcher</h1>
        
        <form id="search-form">
            <input type="text" id="name" placeholder="Search cards">
            <button type="submit">Search</button>
        </form>

        <div id="results"></div>

        <script>
            let cards = [];
            
            async function fetchCards(name = '') {
                const res = await fetch(`/api/mtg-cards?name=${encodeURIComponent(name)}`);
                cards = await res.json();
                renderCards();
            }
        
            function renderCards() {
                const container = document.getElementById('results');
                container.innerHTML = '';
            
                cards.forEach(card => {
                    container.innerHTML += `
                        <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                            <h3>${card.name}</h3>
                            <p>${card.types?.join(', ')}</p>
                            <p>${card.colors?.join(', ')}</p>
                        
                            <!-- future button -->
                            <button onclick="addToDeck(${card.id})">
                                Add to Deck
                            </button>
                        </div>
                    `;
                });
            }
        
            async function addToDeck(cardId) {
                try {
                    const res = await fetch('/api/deck/add-card', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            card_id: cardId
                        })
                    });
                
                    if (res.status === 401) {
                        alert('You must be logged in');
                        return;
                    }
                
                    alert('Card added to deck!');
                } catch (err) {
                    console.error(err);
                }
            }
        
            document.getElementById('search-form').addEventListener('submit', e => {
                e.preventDefault();
                fetchCards(document.getElementById('name').value);
            });
        
            fetchCards();
        </script>
    @endsection
