<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Book extends Eloquent
{
    protected $fillable = ['title','author','price'];
}
