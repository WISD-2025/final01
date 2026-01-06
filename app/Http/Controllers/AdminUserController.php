<?php

namespace App\Http\Controllers;

use App\Models\User; // 引入 User Model
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 抓取所有使用者資料
        $users = User::orderBy('id', 'asc')->get();

        $data = [
            'users' => $users,
        ];

        return view('admin.users.index', $data);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:user,admin', // 確保角色只能是這兩個值
        ]);

        // 防止管理員不小心把自己從 admin 變成 user (導致無法再進後台)
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()->with('error', '無法取消自己的管理員權限！');
        }

        $user->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // 防止刪除目前登入的帳號
        if ($user->id === auth()->id()) {
            return back()->with('error', '不能刪除自己的帳號！');
        }

        // 執行資料庫刪除
        $user->delete();

        // 跳轉回到人員列表頁
        return redirect()->route('admin.users.index');
    }
}
