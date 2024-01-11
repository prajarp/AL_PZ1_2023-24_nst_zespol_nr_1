<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
    ];

    public function books(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'category_id', 'id');
    }
}
