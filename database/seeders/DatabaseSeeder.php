<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Faker\Provider\en_US\Company;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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


        $authorImages = storage_path('app\public\imgAuthors');
        $images = File::allFiles($authorImages);
        foreach (range(1, 100) as $_) {
            // $randomFile = str_replace('\app\public', '', str_replace('C:\xampp\htdocs\book-store', '', $images[rand(0, count($images) - 1)]));
            $randomFile = str_replace('\app\public', '', str_replace('C:\xampp\htdocs\book-store', '/book-store/public_html', $images[rand(0, count($images) - 1)]));
            $randomFile = str_replace('\\', '/', $randomFile);
            DB::table('authors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'photo' => $randomFile,
                'about' => $faker->realText(rand(10, 500)),
            ]);
        }

        $booksCount = 200;
        $bookImages = storage_path('app\public\imgBooks');
        $images = File::allFiles($bookImages);
        foreach (range(1, $booksCount) as $_) {
            $randomFile = str_replace('\app\public', '', str_replace('C:\xampp\htdocs\book-store', '/book-store/public_html', $images[rand(0, count($images) - 1)]));
            $randomFile = str_replace('\\', '/', $randomFile);
            DB::table('books')->insert([
                'title' => $faker->realText(rand(15, 60)),
                'about' => $faker->realText(rand(15, 500)),
                'photo' => $randomFile,
                'year' => rand(1999, 2021),
                'author_id' => rand(1, 100),

            ]);
        }




        foreach (range(1, 900) as $_) {
            DB::table('comments')->insert([
                'guest_name' => $faker->userName(),
                'guest_email' => $faker->email(),
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