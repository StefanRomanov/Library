<?php


namespace App\Helpers;


use Illuminate\Support\Facades\App;
use Mockery;

class AppHelper
{
    public static function mock($class){
        $mock = Mockery::mock($class);
        App::instance($class, $mock);
        return $mock;

    }
}
