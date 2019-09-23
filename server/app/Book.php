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

    /**
     * @param $query
     * @param $searchString
     * @param $order
     * @return mixed
     */
    public function scopeSearch($query, $searchString, $order)
    {

        if($searchString == null || $searchString == ''){
            return $query->orderBy($order);
        }

        return $query
            ->where('title', 'LIKE', '%' . $searchString . '%')
            ->orWhere('author', 'LIKE', '%' . $searchString . '%')
            ->orderBy($order);
    }
}
