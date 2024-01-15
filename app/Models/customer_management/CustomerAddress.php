<?php

namespace App\Models\customer_management;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customer_management\Customer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{  
    use HasFactory;
    protected $fillable=['customer_id','type','first_name',
                            'last_name','phone','estate',
                            'address2',
                            'street_address',
                            'apartment_name','house_number'];

    public function customer():BelongsTo{
      return  $this->belongsTo(Customer::class);
    }

}
