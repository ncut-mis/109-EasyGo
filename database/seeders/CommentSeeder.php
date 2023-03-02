<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::truncate();//重製資料表

            $recipeIds = [1,2,3,4,5,6,7];//目前食譜編號(1~7)

            collect($recipeIds)->each(function ($recipeId) {
                //每一個食譜建立兩則主留言
                Comment::factory(2)->create(['recipe_id' => $recipeId,])
                    ->each(function ($comment) {
                        Comment::factory(2)->create([
                            'recipe_id' => $comment->recipe_id,//次留言的食譜編號為主留言的食譜編號
                            'comment_id' => $comment->id,//次留言的留言編號為主留言的編號
                        ]);
                    });
            });
    }
}

