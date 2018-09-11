<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	 $faker = Faker\Factory::create();

		    for($i = 0; $i < 1000; $i++) {
		        App\Comment::create([
		        'user_id' => 1,
		        'body' => $faker->text,
		        'post_id' => rand(1,1000),
		    ]);
		    }
  
    }
}
