<?php

use Faker\Generator as Faker;

$factory->define(App\Trade::class, function (Faker $faker) {
    return [
        'requested_book_id' => function () {
            return factory(\App\Book::class)->create()->id;
        },
        'offered_book_id' => function () {
            return factory(\App\Book::class)->create()->id;
        },
        'status' => 'pending'
    ];
});
