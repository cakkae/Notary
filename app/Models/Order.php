<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'order_id';
    protected $table = 'order';
}
