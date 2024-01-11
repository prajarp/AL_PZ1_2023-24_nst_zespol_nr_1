<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'rating';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'book_id',
        'user_id',
        'rating',

    ];

    public function books(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'book_id', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
