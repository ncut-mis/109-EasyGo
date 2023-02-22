<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();//重制資料表
        Product::truncate();//重制資料表
        $faker=Factory::create();
        //$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        //肉類
        Category::factory(['name'=>'肉類'])->create();
        $id=Category::where('name','肉類')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'牛肉'])->has(Product::factory(2,['name'=>$faker->country.'牛肉']))->create();
        Category::factory(['category_id'=>$id,'name'=>'豬肉'])->has(Product::factory(2,['name'=>$faker->city.'豬肉']))->create();
        Category::factory(['category_id'=>$id,'name'=>'羊肉'])->has(Product::factory(2,['name'=>$faker->city.'羊肉']))->create();
        Category::factory(['category_id'=>$id,'name'=>'雞肉'])->has(Product::factory(2,['name'=>$faker->city.'雞肉']))->create();

        //蔬菜
        Category::factory(['name'=>'蔬菜'])->create();
        $id=Category::where('name','蔬菜')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'菠菜'])->has(Product::factory(2,['name'=>$faker->country.'菠菜']))->create();
        Category::factory(['category_id'=>$id,'name'=>'空心菜'])->has(Product::factory(2,['name'=>$faker->city.'空心菜']))->create();
        Category::factory(['category_id'=>$id,'name'=>'高麗菜'])->has(Product::factory(2,['name'=>$faker->city.'高麗菜']))->create();
        Category::factory(['category_id'=>$id,'name'=>'大陸妹'])->has(Product::factory(2,['name'=>$faker->city.'大陸妹']))->create();

        //水果
        Category::factory(['name'=>'水果'])->create();
        $id=Category::where('name','水果')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'蘋果'])->has(Product::factory(2,['name'=>$faker->country.'蘋果']))->create();
        Category::factory(['category_id'=>$id,'name'=>'橘子'])->has(Product::factory(2,['name'=>$faker->city.'橘子']))->create();
        Category::factory(['category_id'=>$id,'name'=>'葡萄'])->has(Product::factory(2,['name'=>$faker->city.'葡萄']))->create();
        Category::factory(['category_id'=>$id,'name'=>'蓮霧'])->has(Product::factory(2,['name'=>$faker->city.'蓮霧']))->create();

        //穀物
        Category::factory(['name'=>'穀物'])->create();
        $id=Category::where('name','穀物')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'小麥'])->has(Product::factory(2,['name'=>$faker->country.'小麥']))->create();
        Category::factory(['category_id'=>$id,'name'=>'米'])->has(Product::factory(2,['name'=>$faker->city.'米']))->create();
        Category::factory(['category_id'=>$id,'name'=>'玉米'])->has(Product::factory(2,['name'=>$faker->city.'玉米']))->create();
        Category::factory(['category_id'=>$id,'name'=>'薏仁'])->has(Product::factory(2,['name'=>$faker->city.'薏仁']))->create();

        //奶類
        Category::factory(['name'=>'奶類'])->create();
        $id=Category::where('name','奶類')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'全脂牛奶'])->has(Product::factory(2,['name'=>$faker->country.'全脂牛奶']))->create();
        Category::factory(['category_id'=>$id,'name'=>'低脂牛奶'])->has(Product::factory(2,['name'=>$faker->city.'低脂牛奶']))->create();
        Category::factory(['category_id'=>$id,'name'=>'優酪乳'])->has(Product::factory(2,['name'=>$faker->city.'優酪乳']))->create();
        Category::factory(['category_id'=>$id,'name'=>'起司'])->has(Product::factory(2,['name'=>$faker->city.'起司']))->create();

        //調味
        Category::factory(['name'=>'調味'])->create();
        $id=Category::where('name','調味')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'醬油'])->has(Product::factory(2,['name'=>$faker->country.'醬油']))->create();
        Category::factory(['category_id'=>$id,'name'=>'醋'])->has(Product::factory(2,['name'=>$faker->city.'醋']))->create();
        Category::factory(['category_id'=>$id,'name'=>'鹽'])->has(Product::factory(2,['name'=>$faker->city.'鹽']))->create();
        Category::factory(['category_id'=>$id,'name'=>'胡椒'])->has(Product::factory(2,['name'=>$faker->city.'胡椒']))->create();

        //菇類
        Category::factory(['name'=>'菇類'])->create();
        $id=Category::where('name','菇類')->first()->id;
        Category::factory(['category_id'=>$id,'name'=>'杏包菇'])->has(Product::factory(2,['name'=>$faker->country.'杏包菇']))->create();
        Category::factory(['category_id'=>$id,'name'=>'鴻喜菇'])->has(Product::factory(2,['name'=>$faker->city.'鴻喜菇']))->create();
        Category::factory(['category_id'=>$id,'name'=>'香菇'])->has(Product::factory(2,['name'=>$faker->city.'香菇']))->create();
        Category::factory(['category_id'=>$id,'name'=>'金針菇'])->has(Product::factory(2,['name'=>$faker->city.'金針菇']))->create();


    }
}
