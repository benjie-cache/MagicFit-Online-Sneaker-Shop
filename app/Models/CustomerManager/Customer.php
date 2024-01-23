<?php

namespace App\Models\CustomerManager;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ShoppingProcessManager\Order;
use App\Models\ShoppingProcessManager\OrderDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use  Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CustomerManager\CustomerAddress;
use App\Models\ShoppingProcessManager\Payment;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=['first_name', 'last_name', 'phone', 'type', 'user_id'];
    
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }
    public function orders():HasMany{
        return $this->hasMany(Order::class);
    }
    public function orderDetails():HasMany{
        return $this->hasMany(OrderDetail::class);
    }
    public function payments():HasMany{
        return $this->hasMany(Payment::class);
    }
}
