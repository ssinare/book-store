<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Faker\Provider\en_US\Company;
use Faker\Provider\DateTime;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker::create('lt_LT');



        foreach (range(1, 100) as $_) {
            DB::table('authors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'photo' => $faker->imageUrl(200, 100, 'author'),
                'about' => $faker->realText(rand(10, 500)),
            ]);
        }

        $booksCount = 200;
        foreach (range(1, $booksCount) as $_) {
            DB::table('books')->insert([
                'title' => $faker->realText(rand(15, 60)),
                'about' => $faker->realText(rand(15, 500)),
                'photo' => $faker->imageUrl(200, 100, 'cats'),
                'year' => rand(1999, 2021),
                'author_id' => rand(1, 100),

            ]);
        }



        foreach (range(1, 900) as $_) {
            DB::table('comments')->insert([
                'guest_name' => $faker->userName(),
                'guest_email' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'comment' => $faker->realText(rand(10, 200)),
                'commentable_type' => 'App\Models\Author',
                'commentable_id' => rand(1, 100),
                'created_at' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),

            ]);
        }

        foreach (range(1, 900) as $_) {
            DB::table('comments')->insert([
                'guest_name' => $faker->userName(),
                'guest_email' => $faker->email(),
                'comment' => $faker->realText(rand(10, 200)),
                'commentable_type' => 'App\Models\Book',
                'commentable_id' => rand(1, 200),
                'created_at' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),

            ]);
        }
    }
}