<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('blog_post')->delete();

        $faker = Faker\Factory::create();

        for($ii = 0; $ii < 20; $ii++){
            App\BlogPost\BlogPost::create(array(
                'title' => $faker->sentence(),
                'intro_text' => $faker->paragraph(10),
                'body_text' => $faker->paragraph(round(rand(10,20))).$faker->paragraph(round(rand(10,30))).$faker->paragraph(round(rand(10,15))),
                'created_by' => 2,
                'last_updated_by' => 2,
                'enabled' => 1
            ));
        }

        Model::reguard();
    }
}
