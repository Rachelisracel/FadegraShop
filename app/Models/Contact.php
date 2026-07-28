<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Cập nhật lại danh sách các cột cho phép nhập dữ liệu
    protected $fillable = [
        'user_id',
        'full_name',
        'phone_number',
        'email',
        'order_code',
        'subject',
        'message',
        'status',
        'reply',
    ];

    // Khai báo mối quan hệ với User (nếu cần lấy thông tin tài khoản gửi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ==== ACCESSORS ĐỂ TƯƠNG THÍCH NGƯỢC VỚI CODE CŨ ====
    // Cho phép view dùng $contact->name thay vì $contact->full_name
    public function getNameAttribute()
    {
        return $this->attributes['full_name'] ?? null;
    }

    // Cho phép view dùng $contact->phone thay vì $contact->phone_number
    public function getPhoneAttribute()
    {
        return $this->attributes['phone_number'] ?? null;
    }
}