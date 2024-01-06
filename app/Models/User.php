<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\shopping_process\OrderDetail;
use App\Models\shopping_process\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\shopping_process\ShoppingSession;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

                
   //shopping session user relation
   public function shopping_session():HasOne{
    return $this->hasOne(ShoppingSession::class);
   }
   public function orders():HasMany{
    return $this->hasMany(Order::class);
   }
   //order
   public function order_detail():HasOne{
     return $this->hasOne(OrderDetail::class);
   }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
