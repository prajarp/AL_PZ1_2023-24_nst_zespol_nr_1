<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'pages',
        'price',
        'quantity',
        'img_path',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    public function borrowedBooks(): HasMany
    {
        return $this->hasMany(BorrowedBooks::class, 'id', 'book_id');
    }

    public function cartElements(): HasMany
    {
        return $this->hasMany(CartElements::class, 'book_id','id');
    }
    
    public function rating(): HasMany
    {
        return $this->hasMany(Rating::class, 'book_id','id');
    }

}
