<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salaries extends Model
{
    use HasFactory;

    protected $table = "salaries";
    protected $primaryKey = "id";

    protected $guarded = [];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }
}
