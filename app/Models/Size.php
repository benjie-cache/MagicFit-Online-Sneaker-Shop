<?php

namespace App\Models;
use app\Models\Stock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    use HasFactory;
    public function stocks():HasMany
    {
        return $this->hasMany(Stock::class);
    }
}