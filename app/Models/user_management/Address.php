<?php

namespace App\Models\user_management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\user_management\User;

class Address extends Model
{
    use HasFactory;
    public function user():BelongsTo {
          return $this->belongsTo(User::class);
    }
}
