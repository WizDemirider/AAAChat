<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\P2PMsg;
use Faker\Generator as Faker;


$factory->define(P2PMsg::class, function (Faker $faker) {
    $users = \App\User::all();
    $from = array();
    $to = array();
    foreach($users as $user) {
        array_push($from, $user->phone);
        array_push($to, $user->phone);
    }
    do
    {
        $rfrom = $from[array_rand($from)];
        $rto = $to[array_rand($to)];
    }
    while($rfrom == $rto);

    return [
        'sender' => $rfrom,
        'receiver' => $rto,
        'message' => $faker->sentence,
    ];
});
