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
                'about' => $faker->realText(rand(10, 200)),
            ]);
        }

        $booksCount = 200;
        foreach (range(1, $booksCount) as $_) {
            DB::table('books')->insert([
                'title' => $faker->word(rand(2, 5)),
                'about' => $faker->realText(rand(10, 20)),
                'year' => rand(1999, 2021),
                'author_id' => rand(1, 100),

            ]);
        }

        $commentsCount = 200;

        foreach (range(1, $commentsCount) as $_) {
            DB::table('comments')->insert([
                'user' => $faker->userName(),
                'date' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'comment' => $faker->realText(rand(10, 200)),
                'author_id' => null,
                'book_id' => rand(1, 200)

            ]);
        }

        foreach (range(1, $commentsCount) as $_) {
            DB::table('comments')->insert([
                'user' => $faker->firstName(),
                'date' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
                'comment' => $faker->realText(rand(10, 200)),
                'author_id' => rand(1, 100),
                'book_id' => null

            ]);
        }
    }
}