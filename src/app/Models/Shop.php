<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'category',
        'overview',
        'image',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    // 検索機能
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
