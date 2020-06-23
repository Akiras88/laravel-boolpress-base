<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\Post;
use Faker\Generator as Faker;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $comments = 20;
        $posts = Post::all();

        for ($i = 0; $i < $comments; $i++) {
            $newComment = new Comment();

            $newComment->post_id = $posts->random()->id;
            $newComment->name = $faker->name();
            $newComment->title = $faker->text(50);
            $newComment->body = $faker->text(400);

            $newComment->save();
        }
    }
}