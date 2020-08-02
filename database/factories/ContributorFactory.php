<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contributor;
use Faker\Generator as Faker;

$factory->define(Contributor::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'category_id' => function () {
            return factory('App\User')->create()->id;
        },
        'contribution' => 25
    ];
});
