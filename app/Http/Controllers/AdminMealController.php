<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Category; // 引入 Category Model
use Illuminate\Http\Request;

class AdminMealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = Meal::orderBy('id', 'asc')->get();

        $data = [
            'meals' => $meals,
        ];

        return view('admin.meals.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 抓取所有類別，讓下拉選單可以選擇
        $categories = Category::all();

        $data = [
            'categories' => $categories,
        ];

        return view('admin.meals.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 驗證資料
        $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required',
        'stock' => 'required|numeric',
        ]);

        // 存入資料庫
        Meal::create($request->all());
        // 跳轉回到列表頁，顯示成功訊息
        return redirect()->route('admin.meals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
