<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'title'                 =>  $faker->sentence(4),
        'description'           =>  $faker->paragraph(4),
        'series_id'             =>  function(){
           return factory(\App\Series::class)->create()->id;
        },
        'episode_number'        =>  10,
        'video_id'              =>  '230485453'
    ];
});