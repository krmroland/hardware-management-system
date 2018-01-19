<?php

use Faker\Generator as Faker;

$fields = function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phoneNumber' => $faker->bothify('07########'),
    ];
};
$factory->define(App\Supplier::class, $fields);

$factory->define(App\Customer::class, $fields);
