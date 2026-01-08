<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. 取得前端傳來的 localStorage 資料
        $cart  = $request->input('cart');
        $total = $request->input('total');

        if (empty($cart)) {
            return response()->json(['message' => '購物車為空'], 400);
        }

        try {
            // 使用資料庫事務，確保主表與明細同時成功
            return DB::transaction(function () use ($cart, $total) {

                // 2. 建立訂單主表
                $order = Order::create([
                    'user_id'     => auth()->id() ?? 1, // 若沒做登入暫時用 1
                    'total_price' => $total,
                    'status'      => 'pending',
                ]);

                // 3. 建立訂單明細
                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'meal_id'  => $item['id'],   // 前端 cart 存的餐點 id
                        'quantity' => $item['qty'],  // 數量
                    ]);
                }

                return response()->json([
                    'message'  => '訂單建立成功',
                    'order_id' => $order->id,
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json(['message' => '發生錯誤: ' . $e->getMessage()], 500);
        }
    }

    // 其他 resource 方法可先保留空的
    public function index() {}
    public function create() {}
    public function show(Order $order) {}
    public function edit(Order $order) {}
    public function update(Request $request, Order $order) {}
    public function destroy(Order $order) {}
}
