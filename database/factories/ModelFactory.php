<?php

$factory->define(App\Model\Comment::class, function (Faker\Generator $faker) {
    return [
        'content_id' => function () {
             return factory(App\Model\Content::class)->create()->id;
        },
        'parent' => $faker->randomNumber(),
        'is_blog' => $faker->randomNumber(),
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'url' => $faker->url,
        'content' => $faker->text,
    ];
});

$factory->define(App\Model\Content::class, function (Faker\Generator $faker) {
    return [
        'metas_id' => function () {
             return factory(App\Model\Metas::class)->create()->id;
        },
        'title' => $faker->word,
        'slug' => $faker->word,
        'cover' => $faker->word,
        'summary' => $faker->word,
        'text' => $faker->text,
        'html' => $faker->text,
        'view_count' => $faker->randomNumber(),
        'favorite_count' => $faker->randomNumber(),
        'order' => $faker->randomNumber(),
        'user_id' => $faker->randomNumber(),
        'types' => $faker->word,
        'criticism' => $faker->word,
        'template' => $faker->word,
        'status' => $faker->word,
        'pwd' => $faker->word,
        'quote' => $faker->word,
        'commentsNum' => $faker->randomNumber(),
    ];
});

$factory->define(App\Model\Metas::class, function (Faker\Generator $faker) {
    return [
        'parent' => $faker->boolean,
        'types' => $faker->word,
        'slug' => $faker->word,
        'icon' => $faker->word,
        'content_count' => $faker->randomNumber(),
        'description' => $faker->word,
        'types_count' => $faker->randomNumber(),
        'order' => $faker->randomNumber(),
    ];
});

$factory->define(App\Model\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'Headportrait' => $faker->word,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
    ];
});

