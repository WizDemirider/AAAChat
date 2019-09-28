<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'profile_pic' => 'http://via.placeholder.com/150x150',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\P2PMsg::class, function (Faker $faker) {

    $users = DB::select('select * from users');
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