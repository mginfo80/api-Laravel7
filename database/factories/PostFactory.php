<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence($ndWords = 6, $variableNbWords = true),
        'author_id' => User::all()->random(),
        'content'   => $faker->text($maxNbChars = 200) 
    ];
});
