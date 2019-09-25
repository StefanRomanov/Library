<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'author' => $faker->name,
        'title' => Str::random(15),
        'price' => $faker->randomFloat(2,0.01,100)
    ];
});
