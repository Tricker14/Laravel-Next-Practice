<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'address',
        'total_amount',
        'notes'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function product(): HasMany{
        return $this->hasMany(Product::class);
    }
}
