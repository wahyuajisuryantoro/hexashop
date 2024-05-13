<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'shipping_address', 'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
