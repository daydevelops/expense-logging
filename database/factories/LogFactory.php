<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Log;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
    return [
        'payer_id' => function () {
            return factory('App\User')->create()->id;
        },
        'category_id' => function () {
            return factory('App\User')->create()->id;
        },
        'cost' => rand(0,100)
    ];
});
