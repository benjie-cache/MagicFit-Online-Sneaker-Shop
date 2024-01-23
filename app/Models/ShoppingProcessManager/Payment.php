<?php

namespace App\Models\ShoppingProcessManager;

use App\Models\CustomerManager\Customer;
use App\Models\ShoppingProcessManager\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $fillable=['order_id','name','lastname','amount','status','type'];
    public function order():BelongsTo{
        return $this->belongsTo(Order::class);
    }
    public function customer():BelongsTo{
        return $this->belongsTo(Customer::class);
    }
}
