<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    $users = \App\User::all();
    $userlist = array();
    foreach($users as $user)
    {
        array_push($userlist, $user->phone);
    }
    $admin = $userlist[array_rand($userlist)];
    return [
        'name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'admin' => $admin,
        'profile_pic' => 'http://via.placeholder.com/150x150?text=Group',
    ];
});
