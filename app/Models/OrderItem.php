<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo; // 引入 BelongsTo 類別
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    // 多對一反向關聯 (訂單項目屬於哪張訂單)
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // 多對一反向關聯 (訂單項目是哪個餐點)
    public function meal(): BelongsTo
    {
        return $this->belongsTo(meal::class);
    }
}
