<?php

namespace App\Models\shopping_process;

use App\Models\customer_management\Customer;
use App\Models\shopping_process\Order;
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
