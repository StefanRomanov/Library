<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Book extends Eloquent
{
    protected $fillable = ['title', 'author', 'price'];

    public function getPriceAttribute($value){
        return doubleval($value);
    }

    public function setPriceAttribute($value){
        $this->attributes['price'] = doubleval($value);
    }

    protected $casts = [
        'price' => 'double'
    ];

    /**
     * @param $query
     * @param $searchString
     * @param $order
     * @return mixed
     */
    public function scopeSearch($query, $searchString, $order)
    {
        $orderOption = 'Asc';

        if($order =='priceDesc'){
            $order = 'price';
            $orderOption = 'Desc';
        }

        if($searchString == null || $searchString == ''){
            return $query->orderBy($order, $orderOption);
        }

        return $query
            ->where('title', 'LIKE', '%' . $searchString . '%')
            ->orWhere('author', 'LIKE', '%' . $searchString . '%')
            ->orderBy($order, $orderOption);
    }
}
