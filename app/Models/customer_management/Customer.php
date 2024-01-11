<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\shopping_process\Order;
use App\Models\shopping_process\OrderDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use  Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function addresses():HasMany{
        return $this->hasMany(CustomerAddress::class);
    }
    public function orders():HasMany{
        return $this->hasMany(Order::class);
    }
    public function orderDetails():HasMany{
        return $this->hasMany(OrderDetail::class);
    }
}
