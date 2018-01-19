<?php

use Faker\Generator as Faker;

auth()->loginUsingId(1);
$factory->define(App\Product::class, function (Faker $faker) {
    return [
    'name' => $faker->name,
    'unitName' => $faker->name,
    'bundleName' => $faker->name,
    'unitsPerBundle' => $faker->numberBetween(1, 20),
    'category' => $faker->word(1),
    ];
});

$factory->define(App\Products\Variable::class, function (Faker $faker) {
    $price = ((rand(100, 10000) + 1) % 10) * 100;

    return [
     'buyingPrice' => $price,
     'sellingPrice' => $price + 100,
     'quantity' => $faker->numberBetween(1, 20),
    ];
});
