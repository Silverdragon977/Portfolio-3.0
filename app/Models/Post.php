<?php
// Example Model
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Security Mass Assignment
    // Elements in the array are mass assign able
    // Elements that aren't auto filled
    protected $fillable = ['title', 'body'];
    // Post::all() exits here in parent class
}
