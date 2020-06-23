<?php

use Illuminate\Database\Seeder;
use App\InfoComment;
use App\Comment;
use Faker\Generator as Faker;

class InfoCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $comments = Comment::all();
        foreach ($comments as $comment) {
            $newInfo = new InfoComment();

            $newInfo->comment_id = $comment->id;
            $newInfo->phone = $faker->phoneNumber();
            $newInfo->address = $faker->streetAddress();
            $newInfo->avatar = $faker->imageUrl(540, 380);
            
            $newInfo->save();
        }
    }
}
