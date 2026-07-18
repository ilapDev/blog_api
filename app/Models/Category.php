<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use AsSource;

    protected $fillable = [
        'title',
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}