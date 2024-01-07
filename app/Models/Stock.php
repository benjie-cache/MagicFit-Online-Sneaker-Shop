<?php

namespace App\Models;
use App\Models\Color;
use App\Models\Size;
use App\Models\product_management\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;
    // protected $dispatchesEvents = [
    //     'saving' => 'checkStock',
    // ];
    // public function checkStock()
    // {
    //     // Ensure that the stock quantity doesn't go below zero
    //     if ($this->quantity < 0) {
    //         throw new \Exception('Stock quantity cannot go below zero.');
    //     }
    // }
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color():BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function size():BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
