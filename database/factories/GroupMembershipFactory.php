<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GroupMembership;
use Faker\Generator as Faker;

$factory->define(GroupMembership::class, function (Faker $faker) {
    $grp = \App\Group::all()->random(1)->first();
    do {
        $user = \App\User::all()->random(1)->first();
    } while($user->phone != $grp->admin && \App\GroupMembership::where([['user', '=', $user->phone], ['group', '=', $grp->id]])->exists());
        // careful here, this can go into infinite loop

    return [
        'group' => $grp->id,
        'user' => $user->phone,
    ];
});
