<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'title' => ucfirst($faker->words(3, true)),
        'img' => 'https://via.placeholder.com/480x640',
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
