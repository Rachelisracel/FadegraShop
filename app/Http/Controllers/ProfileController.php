<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // 1. Hàm hiển thị giao diện trang Tài khoản cá nhân
    public function index()
    {
        $user = Auth::user();
        return view('profile.account', compact('user'));
    }

    // 2. Hàm xử lý logic lưu dữ liệu xuống Database
    public function update(Request $request)
    {
        // Bước A: Kiểm tra tính hợp lệ của dữ liệu (Validation)
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'nullable|string|max:15',
            'gender'        => 'nullable|in:male,female,other',
            'identity_card' => 'nullable|string|max:20',
            'dob'           => 'nullable|date',
            'province_id'   => 'nullable|string',
            'district_id'   => 'nullable|string',
            'ward_id'       => 'nullable|string',
            'address'       => 'nullable|string|max:255',
        ], [
            // Tùy chỉnh câu thông báo lỗi (nếu khách hàng nhập sai)
            'name.required' => 'Họ và tên không được để trống.',
            'name.max'      => 'Họ và tên không được vượt quá 255 ký tự.',
            'dob.date'      => 'Ngày sinh không đúng định dạng.',
        ]);

        // Bước B: Lấy thông tin tài khoản đang đăng nhập
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Bước C: Gán các giá trị từ Form vào các cột trong Database
        $user->name          = $request->input('name');
        $user->phone         = $request->input('phone');
        $user->gender        = $request->input('gender');
        $user->identity_card = $request->input('identity_card');
        $user->dob           = $request->input('dob');
        $user->province_id   = $request->input('province_id');
        $user->district_id   = $request->input('district_id');
        $user->ward_id       = $request->input('ward_id');
        $user->address       = $request->input('address');

        // Bước D: Thực thi lệnh lưu vào cơ sở dữ liệu
        $user->save();

        // Bước E: Trả về trang cũ kèm theo thông báo màu xanh
        return back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }
}