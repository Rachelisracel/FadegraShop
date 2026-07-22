<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    public $timestamps = false; // Bảng này không có timestamps trong SQL của bạn
    protected $fillable = ['name', 'price', 'status'];

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class, 'cart_item_toppings', 'topping_id', 'cart_item_id');
    }

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class, 'order_item_toppings', 'topping_id', 'order_item_id');
    }
}