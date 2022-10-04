<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Image extends Model
{
    use HasFactory;
    use HasFactory; // called twice

    protected $fillable = [ 'sourceOfImg' ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function category(): HasOneThrough
    {
        return $this->hasOneThrough(Category::class, Product::class);
    }

    //good
}
