<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; 
use App\Mail\SendOtpMail; 



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

     

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email này chưa được đăng ký trong hệ thống.'
        ]);

        $otp = rand(100000, 999999);

        session([
            'otp_code' => $otp,
            'otp_email' => $request->email
        ]);

        // Xóa dòng dd() đi và gọi hàm gửi Mail thật:
        Mail::to($request->email)->send(new SendOtpMail($otp));

        // Chuyển hướng sang trang nhập OTP (bạn cần có route verify-otp trước đó)
        return redirect()->route('verify-otp')->with('success', 'Mã OTP đã được gửi đến email của bạn.');
    }
    
    public function showVerifyOtp()
    {
        // Kiểm tra xem khách đã nhập email ở bước trước chưa, nếu chưa thì đuổi về trang quên mật khẩu
        if (!session()->has('otp_email')) {
            return redirect()->route('forgot-password')->withErrors(['email' => 'Vui lòng nhập email trước.']);
        }

        return view('clients.pages.verify-otp');
    }

    // Hàm hiển thị trang Quên mật khẩu
    public function forgotPassword()
    {
        return view('clients.pages.forgot-password'); 
    }

    // 1. Hàm kiểm tra mã OTP khách nhập
    public function processVerifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        $sessionOtp = session('otp_code');
        
        // Nếu nhập đúng OTP đã lưu trong session
        if ($request->otp == $sessionOtp) {
            // Đánh dấu là đã xác minh thành công để cho phép qua trang đổi mật khẩu
            session(['otp_verified' => true]);
            
            return redirect()->route('reset-password')->with('success', 'Xác thực thành công! Mời bạn tạo mật khẩu mới.');
        }

        return back()->withErrors(['otp' => 'Mã OTP không chính xác hoặc đã hết hạn.']);
    }

    // 2. Hàm hiển thị form Đổi mật khẩu
    public function showResetPassword()
    {
        // Chặn không cho truy cập thẳng nếu chưa xác minh OTP thành công
        if (!session('otp_verified') || !session('otp_email')) {
            return redirect()->route('forgot-password')->withErrors(['email' => 'Vui lòng xác minh OTP trước.']);
        }

        return view('clients.pages.reset-password');
    }

    // 3. Hàm xử lý lưu mật khẩu mới
    public function processResetPassword(Request $request)
    {
        if (!session('otp_verified') || !session('otp_email')) {
            return redirect()->route('forgot-password');
        }

        // Validate mật khẩu mới
        $request->validate([
            'password' => 'required|min:6|confirmed' // confirmed yêu cầu phải có ô password_confirmation
        ], [
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.'
        ]);

        // Tìm tài khoản theo email và cập nhật mật khẩu
        $user = User::where('email', session('otp_email'))->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Quan trọng: Xóa sạch các session lưu tạm OTP sau khi đổi xong để bảo mật
        session()->forget(['otp_code', 'otp_email', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại.');
    }


    // Hàm xử lý khi khách bấm nút "Gửi lại mã"
    public function resendOtp()
    {
        // Kiểm tra xem khách đã nhập email trước đó chưa
        if (!session()->has('otp_email')) {
            return redirect()->route('forgot-password')->withErrors(['email' => 'Phiên làm việc đã hết hạn. Vui lòng nhập lại email.']);
        }

        // Tạo mã OTP mới
        $newOtp = rand(100000, 999999);

        // Cập nhật mã mới vào Session (đè lên mã cũ)
        session(['otp_code' => $newOtp]);

        // Gửi lại email
        \Illuminate\Support\Facades\Mail::to(session('otp_email'))->send(new \App\Mail\SendOtpMail($newOtp));

        // Quay lại đúng trang nhập OTP kèm theo thông báo màu xanh
        return back()->with('success', 'Một mã OTP mới vừa được gửi. Vui lòng kiểm tra lại hộp thư (cả thư rác).');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
