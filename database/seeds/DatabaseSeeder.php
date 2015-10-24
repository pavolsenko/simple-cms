<?php

use Illuminate\Database\Seeder;
use App\Blog\UrlService;
use Faker\Factory as Faker;
use App\Blog\BlogPost;
use App\Blog\Author;
use App\Blog\Comment;
use App\Blog\CommentAuthor;
use App\Blog\SocialProfile;
use App\Blog\BlogCategory;

class DatabaseSeeder extends Seeder
{

    private $faker;
    private $blogPost;
    private $author;
    private $urlService;
    private $comment;
    private $commentAuthor;
    private $socialProfile;
    private $blogCategory;

    public function __construct(Faker $faker, BlogPost $blogPost, Author $author, UrlService $urlService, Comment $comment, CommentAuthor $commentAuthor, SocialProfile $socialProfile, BlogCategory $blogCategory) {
        $this->faker = $faker;
        $this->blogPost = $blogPost;
        $this->author = $author;
        $this->urlService = $urlService;
        $this->comment = $comment;
        $this->commentAuthor = $commentAuthor;
        $this->socialProfile = $socialProfile;
        $this->blogCategory = $blogCategory;
    }

    public function run()
    {

        /* This will seed a complete DB of a blog with fake blog posts, authors, categories and comments */

        echo "\nSetting up stuff";

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->blogPost->unguard();
        $this->author->unguard();
        $this->comment->unguard();
        $this->socialProfile->unguard();
        $this->blogCategory->unguard();

        $this->blogPost->truncate();
        $this->author->truncate();
        $this->comment->truncate();
        $this->socialProfile->truncate();
        $this->blogCategory->truncate();

        $this->faker = $this->faker->create();

        echo "\nSeeding blog authors";

        for ($ii = 0; $ii < 30; $ii++) {
            $this->author = new Author();
            $this->author->user_id = 2;
            $this->author->first_name = $this->faker->firstName;
            $this->author->last_name = $this->faker->lastName;
            $this->author->title = $this->faker->sentence(3);
            $this->author->bio = $this->faker->paragraph(5);
            $this->author->website = $this->faker->url;
            $this->author->save();

            if (rand(0, 1)) {
                $this->socialProfile = new SocialProfile();
                $this->socialProfile->author_id = $this->author->id;
                $this->socialProfile->type = 'facebook';
                $this->socialProfile->name = $this->author->first_name.' '.$this->author->last_name;
                $this->socialProfile->handle = $this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->link = 'http://facebook.com/'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->save();
            }

            if (rand(0, 1)) {
                $this->socialProfile = new SocialProfile();
                $this->socialProfile->author_id = $this->author->id;
                $this->socialProfile->type = 'twitter';
                $this->socialProfile->name = $this->author->first_name.' '.$this->author->last_name;
                $this->socialProfile->handle = '@'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->link = 'http://twitter.com/'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->save();
            }

            if (rand(0, 1)) {
                $this->socialProfile = new SocialProfile();
                $this->socialProfile->author_id = $this->author->id;
                $this->socialProfile->type = 'google_plus';
                $this->socialProfile->name = $this->author->first_name.' '.$this->author->last_name;
                $this->socialProfile->handle = $this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->link = 'http://plus.google.com/'.$this->author->first_name.'.'.$this->author->last_name;
                $this->socialProfile->save();
            }

            echo '.';
        }

        echo "\nSeeding blog categories";

        for ($ii = 0; $ii < 10; $ii++) {
            $this->blogCategory = new BlogCategory();
            $this->blogCategory->title = ucfirst($this->faker->word()).' '.$this->faker->word().' '.$this->faker->word();
            $this->blogCategory->description = $this->faker->paragraph(round(rand(10, 20)));
            $this->blogCategory->created_by = 2;
            $this->blogCategory->updated_by = $this->blogCategory->created_by;
            $this->blogCategory->enabled = 1;
            $this->blogCategory->url = $this->urlService->createUrlFromTitle($this->blogCategory->title);
            $this->blogCategory->save();
            echo '.';
        }

        echo "\nSeeding blog posts";

        for ($ii = 0; $ii < 30; $ii++) {
            $this->blogPost = new BlogPost();
            $this->blogPost->title = $this->faker->sentence(10, true);
            $this->blogPost->intro_text = $this->faker->paragraph(round(rand(10,20)));
            for ($jj = 0; $jj < round(rand(3,10)); $jj++) {
                $this->blogPost->body_text .= '<div>'.$this->faker->paragraph(round(rand(10, 30))).'</div><br>';
            }
            $this->blogPost->author_id = round(rand(1, 30));
            $this->blogPost->created_by = 2;
            $this->blogPost->updated_by = $this->blogPost->created_by;
            $this->blogPost->enabled = 1;
            $this->blogPost->url = $this->urlService->createUrlFromTitle($this->blogPost->title);
            $this->blogPost->save();
            $categories = [];
            for($jj = 0; $jj < 3; $jj++) {
                if (rand(0, 1)) {
                    array_push($categories, round(rand(1, 10)));
                }
            }
            $this->blogPost->categories()->attach($categories);
            echo '.';
        }

        echo "\nSeeding blog comment authors";

        for ($ii = 0; $ii < 30; $ii++) {
            $this->commentAuthor = new CommentAuthor();
            $this->commentAuthor->name = $this->faker->name;
            $this->commentAuthor->email = $this->faker->email;
            $this->commentAuthor->website = $this->faker->url;
            $this->commentAuthor->ip_address = $this->faker->ipv4;
            $this->commentAuthor->save();
            echo '.';
        }

        echo "\nSeeding blog comments";

        for ($ii = 0; $ii < 200; $ii++) {
            $this->comment = new Comment();
            $this->comment->blog_post_id = round(rand(1,30));
            $this->comment->comment_author_id = round(rand(1,30));
            $this->comment->text = $this->faker->paragraph(round(rand(1,10)));
            $this->comment->status = 1;
            $this->comment->save();
            echo '.';
        }

        echo "\nSetting up stuff";

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->blogPost->reguard();
        $this->author->reguard();
        $this->comment->reguard();
        $this->commentAuthor->reguard();

        echo "\nDone\n\n";
    }
}
