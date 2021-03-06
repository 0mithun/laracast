<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use App\Series;
use Faker\Generator as Faker;

$factory->define(Series::class, function (Faker $faker) {
    $title = $faker->sentence(5);
    return [
        'title'             =>  $title,
        'slug'              =>  str_slug($title),
        'image_url'         =>  $faker->imageUrl(),
        'description'       =>  $faker->paragraph()     


    ];
});
