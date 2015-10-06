<?php

use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{

    public function run()
    {

        Eloquent::unguard();

        DB::table('blog_posts')->delete();

        $faker = Faker\Factory::create();

        for($ii = 0; $ii < 10; $ii++){
            App\BlogPost\BlogPost::create(array(
                'title' => $faker->sentence(),
                'intro_text' => $faker->paragraph(5),
                'body_text' => $faker->paragraph(round(rand(1,10))).$faker->paragraph(round(rand(1,10))).$faker->paragraph(round(rand(1,10)))
            ));
        }

    }

}
