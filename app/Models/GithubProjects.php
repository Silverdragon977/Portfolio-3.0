<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubProjects extends Model
{
    //
    protected $fillable = [
        'title',
         'languages',
         'github_link',
         'full_description',
         'short_description'
        ];
}
