<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['cat_name'];

    public $timestamps = false;



    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public static function create()
    {
        return $this->hasMany(Book::class);
    }


}
