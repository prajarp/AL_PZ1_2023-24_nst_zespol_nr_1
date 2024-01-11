<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Users extends Model
{
    use HasFactory;
    
    protected $table = 'users';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'adress',
        'role',
    ];

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }

    public function borrowedBooks(): HasMany
    {
        return $this->hasMany(BorrowedBooks::class, 'id', 'user_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'user_id', 'id');
    }
}
