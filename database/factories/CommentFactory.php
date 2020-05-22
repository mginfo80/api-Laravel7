<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;
use App\User;
use App\Models\Post;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random(),
        'post_id' => Post::all()->random(),
        'content'   => $faker->text($maxNbChars = 200) 
    ];
});
