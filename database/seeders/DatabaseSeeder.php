<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); //關閉外鍵檢查
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductImgSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(RecipeCategorySeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(RecipeImgSeeder::class);
        $this->call(RecipeFilmSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(CollectSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(SuggestSeeder::class);
        $this->call(ItemSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); //開啟外鍵檢查
    }
}
