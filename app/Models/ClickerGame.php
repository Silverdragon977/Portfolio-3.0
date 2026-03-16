<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickerGame extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'multiplier',
        'passive_income_level',
        'prestige_level',
        'background_color',
        'frame_choice',
    
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
