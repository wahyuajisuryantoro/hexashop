<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'category' , 'price', 'image_url'];
    protected $appends = ['full_image_url'];


    public function getFullImageUrlAttribute()
    {
        return asset($this->image_url);
    }

}