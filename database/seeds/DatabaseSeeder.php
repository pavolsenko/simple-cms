<?php

use Illuminate\Database\Seeder;
use App\Blog\UrlService;
use Faker\Factory as Faker;
use App\Blog\BlogPost;

class DatabaseSeeder extends Seeder
{

    private $db;
    private $faker;
    private $blogPost;
    private $urlService;
    private $table;

    public function __construct(Faker $faker, BlogPost $blogPost, UrlService $urlService) {
        $this->faker = $faker;
        $this->blogPost = $blogPost;
        $this->urlService = $urlService;
    }

    public function run()
    {

        /* Filling blog with fake blog posts */

        $this->blogPost->unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->blogPost->truncate();

        $faker = $this->faker->create();
        echo "\nSeeding";

        for ($ii = 0; $ii < 30; $ii++) {
            $this->blogPost = new BlogPost();
            $this->blogPost->title = $faker->sentence(10, true);
            $this->blogPost->intro_text = $faker->paragraph(round(rand(10,20)));
            for ($jj = 0; $jj < round(rand(3,10)); $jj++) {
                $this->blogPost->body_text .= '<div>'.$faker->paragraph(round(rand(10, 30))).'</div><br>';
            }
            $this->blogPost->created_by = 2;
            $this->blogPost->last_updated_by = 2;
            $this->blogPost->enabled = 1;
            $this->blogPost->url = $this->urlService->createUrlFromTitle($this->blogPost->title);
            $this->blogPost->save();
            echo '.';
        }

        echo "\n";
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->blogPost->reguard();
    }
}
