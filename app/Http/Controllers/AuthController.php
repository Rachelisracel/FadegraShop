<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login_field' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = $request->input('login_field');
        $password = $request->input('password');

        // Check if login_field is email or phone
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$fieldType => $loginField, 'password' => $password])) {
        
        // Bảo mật session
        $request->session()->regenerate();

        // Lấy tên quyền (role) của người dùng vừa đăng nhập
        $userRole = Auth::user()->roleRelation->name ?? '';

        // Tất cả đều chuyển về trang chủ, admin sẽ thấy nút Dashboard trên header
        return redirect('/');
    }

        return back()->withErrors([
            'login_field' => 'Email/Số điện thoại hoặc mật khẩu không chính xác.',
        ])->onlyInput('login_field');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
