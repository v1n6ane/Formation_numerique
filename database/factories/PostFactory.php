<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker $faker) {

    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());
    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addMonth();

    $type=rand(1,2);
    switch($type) {
        case 1 : 
            $post_type = 'stage';
            break;
        case 2 : 
            $post_type = 'formation';
            break;
    }

    return [
        'title' => $faker->sentence(),
        'description' => $faker->paragraph(), 
        'nb_max_student' => rand(1,60),
        'price' => rand(50,2000),
        'post_type' => $post_type,
        'start_date' => $startDate,
        'end_date' => $endDate

        /* 'start_date' =>$faker->dateTimeBetween($startDate = '- 1 year', $endDate = 'now', $timezone = null),
        'end_date' =>$faker->dateTimeBetween($startDate = 'now', $endDate = '1 year', $timezone = null) */
    ];
});