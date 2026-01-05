<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany; // 引入 HasMany 類別
use Illuminate\Database\Eloquent\Relations\BelongsTo; // 引入 BelongsTo 類別
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    /** @use HasFactory<\Database\Factories\MealFactory> */
    use HasFactory;

    // 定義多對一反向關聯
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); 
    }

    // 定義一對多關聯 (一項餐點可以出現在多筆訂單項目中)
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
