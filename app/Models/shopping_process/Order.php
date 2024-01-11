<?php

namespace App\Models;

use App\Models\shopping_process\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['total_price', 'status', 'user_id'];
    public function order_items():HasMany{
        return $this->hasMany(OrderItem::class);
    }


   

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
