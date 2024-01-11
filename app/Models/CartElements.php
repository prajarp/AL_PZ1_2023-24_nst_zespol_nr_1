<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartElements extends Model
{
    use HasFactory;

    protected $table = 'cart_elements';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'cart_id',
        'book_id',
        'quantity',
    ];

    public function books(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'book_id', 'id');
    }

    public function cart(): HasOne
    {
        return $this->hasOne(CartElements::class, 'id', 'cart_id');
    }

    
}
