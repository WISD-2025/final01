<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany; // 引入 HasMany 類別
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable=[
        'name',         
    ];

    // 定義一對多的關聯方法
    public function meals(): HasMany
    {
        //這裡指的是一個 `Category` 可以擁有多個 `Meal`
       return $this->hasMany(Meal::class);
    }
}
