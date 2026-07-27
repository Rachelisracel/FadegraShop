<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $timestamps = false;
    protected $fillable = ['cart_id', 'product_id', 'size_id', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class, 'cart_item_toppings', 'cart_item_id', 'topping_id');
    }
}