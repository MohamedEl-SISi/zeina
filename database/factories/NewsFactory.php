<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence('5'),
        'slug' => $faker->slug,
        'publisher_name' =>$faker->name,
        'publish_date' => $faker->dateTime,
        'paragraph_body' => 0,
        'status'=>'published',
        'desc'=>$faker->text,
        'body'=>serialize($faker->sentence(10)),
        'in_home'=>$faker->boolean,
        'editor_id'=>1,
        'publisher_id'=>1,
        'imageId'=>$faker->numberBetween(1, 22),
        'sectionId'=> $faker->numberBetween(1, 8)
    ];
});
