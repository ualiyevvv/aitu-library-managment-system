<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowreq extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'book_id', 'status', 'start_date', 'finish_date'
    ];

    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
