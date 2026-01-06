<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 檢查是否登入，且角色欄位是否為 admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // 如果不是管理員，跳轉回首頁
        return redirect('/');
    }
}
