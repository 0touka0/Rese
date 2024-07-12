<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'address',
        'category',
        'overview',
        'image',
    ];

    public function scopeAddressSearch($query, $address)
    {
        if (!empty($address)) {
            $query->where('address',$address);
        }
    }

    public function scopeCategorySearch($query, $category)
    {
        if (!empty($category) && $category != 'all') {
            $query->where('category',$category);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
}
