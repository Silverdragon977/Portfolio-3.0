<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MtgCardsModel extends Model
{
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
        'purchaseUrls'
    ];

    protected $casts = [
        'colors' => 'array',
        'types' => 'array',
        'subtypes' => 'array',
        'supertypes' => 'array',
        'purchaseUrls' => 'array'
    ];
}
