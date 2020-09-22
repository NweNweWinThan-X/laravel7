<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert data with faker
        $faker = Faker::create('App\Post');
        // for ($i = 1 ; $i <= 50 ; $i++) {
        foreach (range(1, 50) as $index) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'description' => $faker->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
