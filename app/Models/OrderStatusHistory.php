<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $table = 'order_status_history';
    public $timestamps = false;
    protected $fillable = ['order_id', 'status', 'old_status', 'new_status', 'changed_by', 'note'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function changedBy()
{
    return $this->belongsTo(User::class, 'changed_by');
}
}