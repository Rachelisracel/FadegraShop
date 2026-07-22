<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamps = false;
    protected $fillable = ['code', 'discount', 'start_date', 'end_date', 'status'];
}
