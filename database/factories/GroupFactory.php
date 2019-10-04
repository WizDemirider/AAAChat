<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    $users = \App\User::all();
    $userphonelist = array();
    foreach($users as $user)
    {
        array_push($userphonelist, $user->phone);
    }
    $admin_phone = $userphonelist[array_rand($userphonelist)];
    return [
        'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'admin' => $admin_phone,
        'profile_pic' => 'http://via.placeholder.com/150x150?text=Group',
    ];
});
