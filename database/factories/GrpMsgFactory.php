<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GrpMsg;
use Faker\Generator as Faker;

$factory->define(GrpMsg::class, function (Faker $faker) {
    $to = \App\Group::all()->random(1)->first();

    $from = $to->admin;

    return [
        'sender' => $from,
        'receiver' => $to,
        'message' => $faker->sentence,
    ];
});
