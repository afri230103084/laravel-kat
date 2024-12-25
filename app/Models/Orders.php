<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
