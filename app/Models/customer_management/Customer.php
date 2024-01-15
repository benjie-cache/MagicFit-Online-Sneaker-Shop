<?php

namespace App\Models\customer_management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\shopping_process\Order;
use App\Models\shopping_process\OrderDetail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use  Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\customer_management\CustomerAddress;
use App\Models\shopping_process\Payment;

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
