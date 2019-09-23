<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Book extends Eloquent
{
    protected $fillable = ['title', 'author', 'price'];

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
