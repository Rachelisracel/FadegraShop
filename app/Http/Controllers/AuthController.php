<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
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

    public function register(Request $request)
    {
        // 1. Kiểm tra dữ liệu người dùng nhập
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', 
            'phone' => 'required|string|max:15',
        ], [
            'email.unique' => 'Email này đã được sử dụng.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.'
        ]);

        // 2. Tạo tài khoản mới vào Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
            'phone' => $request->phone,
            'role_id' => 3, // Mặc định ai đăng ký cũng là Khách hàng (customer)
            'role' => 'customer',
            'status' => 'active',
        ]);

        // 3. (Tùy chọn) Cho đăng nhập luôn sau khi đăng ký thành công
        // Auth::login($user);

        // 4. Chuyển hướng về trang đăng nhập kèm thông báo
        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
