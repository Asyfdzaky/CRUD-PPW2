<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['title', 'author', 'harga', 'tanggal_terbit', 'image', 'editorial_pick', 'discount'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'book_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function getDiscountedPriceAttribute()
{
    if ($this->discount > 0) {
        return $this->harga - ($this->harga * $this->discount / 100);
    }
    return $this->harga;
}
    
}
