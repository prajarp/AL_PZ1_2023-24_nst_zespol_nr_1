<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'STATUS',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function cartElements(): HasMany
    {
        return $this->hasMany(CartElements::class, 'cart_id', 'id');
    }
}
