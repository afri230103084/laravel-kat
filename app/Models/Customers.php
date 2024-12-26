<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customers extends Authenticatable
{
    use HasFactory;

    protected $table = "customers";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'customer_id');
    }
}
