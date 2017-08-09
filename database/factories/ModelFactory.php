<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
| run in the terminal:
|
| php artisan tinker
| example:
| factory('App\Thread', 50)->create();
|
| also to create an object and pass the id:
| $threads = factory('App\Thread', 50)->create();
| $threads->each(function($thread) { factory('App\Reply', 10)->create(['thread_id' => $thread->id]); });
|
| this will create 10 Replies for each thread of the array of 50 threads
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/**
 * create a fake thread
 */
$factory->define(App\Thread::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

/**
 * create a fake thread
 */
$factory->define(App\Reply::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'thread_id' => function() {
            return factory('App\Thread')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});
