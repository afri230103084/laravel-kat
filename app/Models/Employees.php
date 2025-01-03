<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employees extends Model
{
    use HasFactory;

    protected $table = "employees";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function salaries(): HasMany
    {
        return $this->hasMany(Salaries::class);
    }
}
