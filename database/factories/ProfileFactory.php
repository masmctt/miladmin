<?php


use App\User;
use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
    	//'user_id' => factory(App\User::class),
        'age' => $faker->randomElement(['18','20','23','25','30','35','37','40','45','50','57', '60']),
        'gender' => $faker->randomElement(['male', 'female']),
    ];
});
