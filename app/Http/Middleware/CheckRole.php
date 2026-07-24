<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Kiểm tra xem đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập!');
        }

        // 2. Lấy tên role của user hiện tại
        $userRole = Auth::user()->roleRelation->name ?? '';

        // 3. Kiểm tra xem role của user có nằm trong danh sách các role được phép (truyền từ Route) không
        if (in_array($userRole, $roles)) {
            return $next($request); // Cho phép đi tiếp
        }

        // 4. Nếu không có quyền -> Đuổi về trang chủ hoặc báo lỗi 403
        abort(403, 'Bạn không có quyền truy cập khu vực này.');
    }
}