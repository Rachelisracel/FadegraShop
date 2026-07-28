<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        // Lấy thông tin user hiện tại (nếu đã đăng nhập)
        $user = Auth::user();
        return view('clients.pages.contact', compact('user'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'order_code' => 'nullable|string|max:50',
            'subject'    => 'required|string|max:255',
            'message'    => 'required|string',
        ], [
            'name.required'    => 'Vui lòng nhập họ tên.',
            'email.required'   => 'Vui lòng nhập email.',
            'email.email'      => 'Email không đúng định dạng.',
            'subject.required' => 'Vui lòng nhập tiêu đề.',
            'message.min' => 'Lời nhắn cần có ít nhất 10 ký tự.',
            'message.required' => 'Vui lòng nhập nội dung liên hệ.',
        ]);

        // Lưu thông tin phản hồi vào CSDL
        Contact::create([
            'user_id'      => Auth::id(), // Tự lưu user_id nếu khách đã đăng nhập (nếu không sẽ là null)
            'full_name'    => $request->name,
            'email'        => $request->email,
            'phone_number' => $request->phone,
            'order_code'   => $request->order_code,
            'subject'      => $request->subject,
            'message'      => $request->message,
            'status'       => 'pending',
        ]);

        return redirect()->back()->with('success', 'Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}