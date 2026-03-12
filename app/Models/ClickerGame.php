<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClickerGame extends Model
{
    protected $fillable = [
        'user_id',
        'score',
        'multiplier',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
