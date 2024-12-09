<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
