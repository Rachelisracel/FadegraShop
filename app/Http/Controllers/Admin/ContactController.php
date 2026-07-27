<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Hiển thị danh sách phản hồi
    public function index()
    {
        $contacts = Contact::with('user')->latest()->paginate(10);
        return view('admin.pages.contacts.index', compact('contacts'));
    }

    // Cập nhật trạng thái phản hồi (Chờ xử lý / Đang xử lý / Đã xong)
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,resolved',
        ]);

        $contact->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    // Xóa phản hồi
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Xóa phản hồi thành công!');
    }
}