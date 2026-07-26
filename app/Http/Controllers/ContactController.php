<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị trang Liên hệ
    public function index()
    {
        return view('clients.pages.contact');
    }

    // Xử lý khi khách hàng bấm gửi form
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'message' => 'required|string|min:10',
        ], [
            'message.min' => 'Lời nhắn cần có ít nhất 10 ký tự.',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    }
}