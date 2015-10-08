<?php

use Illuminate\Database\Seeder;
use App\Blog\UrlService;
use Faker\Factory as Faker;
use App\Blog\BlogPost;
use App\Blog\Author;
use App\Blog\Comment;

class DatabaseSeeder extends Seeder
{

    private $faker;
    private $blogPost;
    private $author;
    private $urlService;
    private $comment;

    public function __construct(Faker $faker, BlogPost $blogPost, Author $author, UrlService $urlService, Comment $comment) {
        $this->faker = $faker;
        $this->blogPost = $blogPost;
        $this->author = $author;
        $this->urlService = $urlService;
        $this->comment = $comment;
    }

    public function run()
    {

        /* Filling blog with fake blog posts */

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->blogPost->unguard();
        $this->author->unguard();
        $this->comment->unguard();
        $this->blogPost->truncate();
        $this->author->truncate();
        $this->comment->truncate();

        $this->faker = $this->faker->create();
        echo "\nSeeding";

        for ($ii = 0; $ii < 30; $ii++) {
            $this->author = new Author;
            $this->author->users_id = 2;
            $this->author->first_name = $this->faker->firstName;
            $this->author->last_name = $this->faker->lastName;
            $this->author->title = $this->faker->sentence(3);
            $this->author->bio = $this->faker->paragraph(5);
            $this->website = $this->faker->url;
            $this->author->save();
            echo '.';
        }

        for ($ii = 0; $ii < 30; $ii++) {
            $this->blogPost = new BlogPost();
            $this->blogPost->title = $this->faker->sentence(10, true);
            $this->blogPost->intro_text = $this->faker->paragraph(round(rand(10,20)));
            for ($jj = 0; $jj < round(rand(3,10)); $jj++) {
                $this->blogPost->body_text .= '<div>'.$this->faker->paragraph(round(rand(10, 30))).'</div><br>';
            }
            $this->blogPost->created_by = round(rand(1, 30));
            $this->blogPost->last_updated_by = $this->blogPost->created_by;
            $this->blogPost->enabled = 1;
            $this->blogPost->url = $this->urlService->createUrlFromTitle($this->blogPost->title);
            $this->blogPost->save();
            echo '.';
        }

        echo "\n";

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->blogPost->reguard();
        $this->author->reguard();
    }
}
