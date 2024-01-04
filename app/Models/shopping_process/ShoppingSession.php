<?php

namespace App\Models\shopping_process;

use App\Models\user_management\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingSession extends Model
{
    use HasFactory;
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
