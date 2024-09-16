<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'address_id',
        'category_id',
        'owner_id',
        'name',
        'overview',
        'image',
        'payment_url',
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

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    // 検索機能
    public function scopeAddressSearch($query, $address)
    {
        if (!empty($address)) {
            $query->whereHas('address', function($q) use ($address) {
                $q->where('address',$address);
            });
        }
    }

    public function scopeCategorySearch($query, $category)
    {
        if (!empty($category) && $category != 'all') {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('category', $category);
            });
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
}
