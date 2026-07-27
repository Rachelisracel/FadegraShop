<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $table = 'order_status_history';
    public $timestamps = false;
    protected $fillable = ['order_id', 'status', 'note', 'changed_at'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}