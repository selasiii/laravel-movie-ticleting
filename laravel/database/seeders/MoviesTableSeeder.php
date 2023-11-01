<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        foreach(range(1,20) as $index)
        {
            DB::table('movies')->insert([
                'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                'duration' => $faker->numberBetween($min = 80, $max = 180),
                'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'poster_image' => $faker->imageUrl($width = 640, $height = 480, 'superhero', true, 'Faker'), // Using cat images for now
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
