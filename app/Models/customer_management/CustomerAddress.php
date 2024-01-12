<?php

namespace App\Models\customer_management\CustomerAddress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customer_management\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{  
    use HasFactory;
   

    public function customer():BelongsTo{
      return  $this->belongsTo(Customer::class);
    }

}
