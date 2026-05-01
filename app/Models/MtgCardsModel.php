<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MtgCardsModel extends Model
{
    protected $table = 'mtg_cards_table';
        protected $fillable = [
        'name',
        'mana_cost',
        'converted_mana_cost',
        'colors',
        'types',
        'subtypes',
        'supertypes',
        'description',
        'rarity',
        'purchase_urls',
        'thumbnail_url',
        'full_card_image_url'
    ];

    protected $casts = [
        'colors' => 'array',
        'types' => 'array',
        'subtypes' => 'array',
        'supertypes' => 'array',
        'purchase_urls' => 'array'
    ];
}
