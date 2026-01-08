<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany; // 引入 HasMany 類別
use Illuminate\Database\Eloquent\Relations\BelongsTo; // 引入 BelongsTo 類別
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

     //定義一對一反向關聯 (一張訂單只屬於一位使用者)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //定義一對多關聯 (一張訂單有多個訂單項目)
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
