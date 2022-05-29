<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'caption', 'author', 'descr', 'image', 'category', 'country', 'lang', 'pages', 'isbn', 'shtrih', 'user_id'
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
