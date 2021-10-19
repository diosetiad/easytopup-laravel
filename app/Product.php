<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'categories_id', 'price', 'description', 'slug'
    ];

    protected $hidden = [
    ];

    public function galleries(){
        return $this->hasMany(ProductGallery::class, 'products_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
