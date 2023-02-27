<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use Database\Factories\ProductImgFactory;
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


        $types = [
            '肉類'=>['豬肉','牛肉'],
            '蔬菜'=>['菠菜','空心菜'],
            '水果'=>['蘋果','橘子'],
            '穀物'=>['小麥','糙米'],
            '海鮮'=>['蝦子','龍蝦'],
            '奶類'=>['牛奶','優酪乳'],
            '調味'=>['醬油','鹽'],
            '菇類'=>['香菇','金針菇']
        ];
        foreach ($types as $type=>$info ){
            Category::factory([
                'name'=>$type
            ])->create();
            foreach ($info as $item){
                Category::factory([
                    'name'=>$item,
                    'category_id'=>Category::where('name',$type)->first()->id
                ])
                ->create();
            }
        }

        $produces = [
            '牛肉'=>['美牛','和牛'],
            '豬肉'=>['伊比利豬','台灣豬'],
            '菠菜'=>['有機菠菜','小農菠菜'],
            '空心菜'=>['有機空心菜','小農空心菜'],
            '蘋果'=>['青森蘋果','有機蘋果'],
            '橘子'=>['砂糖橘','帝王柑'],
            '小麥'=>['復興米店-小麥','統一生機-小麥胚芽'],
            '糙米'=>['三好米-一等糙米','皇家穀堡-糙米'],
            '蝦子'=>['天使紅蝦','泰國蝦'],
            '龍蝦'=>['華得水產-野生頂級龍蝦','三頓飯-波士頓龍蝦'],
            '牛奶'=>['全脂牛奶','低脂牛奶'],
            '優酪乳'=>['AB優酪乳','LP33優酪乳'],
            '醬油'=>['萬家香-純釀醬油','龜甲萬-甘醇醬油'],
            '鹽'=>['台鹽-減鈉含碘鹽','統一生機-日曬海鹽'],
            '香菇'=>['埔里香菇-特級香菇','義昌生技-台灣香菇'],
            '金針菇'=>['鄰家生鮮-金針菇','勝花園-金針菇']

        ];
        foreach ($produces as $produce => $info){
            $id=Category::where('name',$produce)->first()->id;
            foreach ($info as $item){
                Product::factory([
                    'category_id' => $id,
                    'name' => $item,
                ])->create();
            }
        }


    }
}
