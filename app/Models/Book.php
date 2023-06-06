<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table='book';

    protected $fillable = [
        'title',
        'isbn13',
        'stock',
        'image',
        'num_pages',
        'author',
        'price',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
