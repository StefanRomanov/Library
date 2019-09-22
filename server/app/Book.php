<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Book extends Eloquent
{
    protected $fillable = ['title', 'author', 'price'];

    /**
     * @param $query
     * @param $searchString
     * @return mixed
     */
    public function scopeSearch($query, $searchString)
    {
        if($searchString == null || $searchString == ''){
            return $query;
        }

        return $query
            ->where('title', 'LIKE', '%' . $searchString . '%')
            ->orWhere('author', 'LIKE', '%' . $searchString . '%');
    }
}
