<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; // 引入 File 工具
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
        'image1' => 'nullable|image|max:2048', // 限制圖片2MB
        ]);

        $data = $request->all();

        if ($request->hasFile('image1')) {
            $file = $request->file('image1');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // 直接存入 public/storage/meals
            $file->move(public_path('storage/meals'), $fileName);
            // 資料庫存入 meals/檔名.jpg
            $data['image1'] = 'meals/' . $fileName;
        }

        // 存入資料庫
         Meal::create($data);
        // 跳轉回到列表頁
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
    public function edit(Meal $meal)
    {
        $categories = Category::all();

        $data = [
            'meal' => $meal,
            'categories' => $categories,
        ];

        return view('admin.meals.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required|numeric',
            'image1' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image1')) {
            // 如果有上傳新圖，先刪除舊圖實體檔案
            if ($meal->image1 && File::exists(public_path('storage/' . $meal->image1))) {
                File::delete(public_path('storage/' . $meal->image1));
            }

            // 存入新圖片
            $file = $request->file('image1');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/meals'), $fileName);
            $data['image1'] = 'meals/' . $fileName;
        } else {
            // 沒上傳新圖時，保留原本的圖片路徑
            unset($data['image1']);
        }

        $meal->update($data);

        return redirect()->route('admin.meals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
