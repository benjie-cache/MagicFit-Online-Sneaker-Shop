<?php

namespace App\Models\shopping_process;

use App\Models\shopping_process\OrderItem;
use App\Models\User;
use App\Models\customer_management\Customer;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['total_price', 'status', 'user_id'];
    public function order_items():HasMany{
        return $this->hasMany(OrderItem::class);
    }


   

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function customer():BelongsTo{
        return $this->belongsTo(Customer::class);
    }
}
