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
        'name',
        'email',
        'phone',
        'order_code',
        'subject',
        'message',
        'status',
    ];

    // Khai báo mối quan hệ với User (nếu cần lấy thông tin tài khoản gửi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}