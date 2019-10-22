<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GrpMsg;
use Faker\Generator as Faker;

$factory->define(GrpMsg::class, function (Faker $faker) {
    $grp = \App\Group::all()->random(1)->first();

    if(\App\GroupMembership::where('group', '=', $grp->id)->exists())
    {
        $user = \App\GroupMembership::where('group', '=', $grp->id)->get()->random(1)->first()->user;
    }
    else {
        $user = $grp->admin;
    }

    return [
        'sender' => $user,
        'receiver' => $grp,
        'message' => $faker->sentence,
        'read' => FALSE,
    ];
});
