<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProfile extends Model
{
    
    protected $table = 'store_profiles';

    protected $fillable = [
        'name_store', 'store_location', 'phone', 'office_location', 'work_hours', 'email',
        'instagram_url', 'facebook_url', 'twitter_url', 'map_url'
    ];
}

