<?php

namespace App\Http\Controllers;

use App\Models\Order; //引入 Order Model
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 抓取所有訂單，並按照狀態權重與 ID 排序
        $orders = Order::with('user')
            ->orderByRaw("CASE 
                WHEN status = 'preparing' THEN 1 
                WHEN status = 'pending' THEN 2 
                ELSE 3 
            END ASC")
            ->orderBy('id', 'asc') //同狀態下按照 ID 排序
            ->get();

        $data = [
            'orders' => $orders,
        ];

        return view('admin.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // 載入 orderItems 以及每個項目對應的 meal 資料
        $order->load(['user', 'orderItems.meal']);

        $data = [
            'order' => $order,
        ];

        return view('admin.orders.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $data = [
            'order' => $order,
        ];

        return view('admin.orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // 確保狀態值
        $request->validate([
            'status' => 'required|in:pending,preparing,completed,cancelled',
        ]);
        // 執行更新
        $order->update([
            'status' => $request->status,
        ]);
        return redirect()->route('admin.orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index');
    }
}
