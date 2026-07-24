<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone', 'avatar', 'role_id', 'status'];

    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Kiểm tra xem có phải Admin không
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Kiểm tra xem có phải Nhân viên không
    public function isStaff()
    {
        return $this->role === 'staff';
    }

    // Kiểm tra xem có phải Admin HOẶC Nhân viên không (Để cho phép vào trang Dashboard)
    public function hasAdminAccess()
    {
        return in_array($this->role, ['admin', 'staff']);
    }

}