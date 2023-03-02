<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::truncate();//重制資料表
        $members=Member::all();
        foreach ($members as $member){
            Item::factory(4,[
                'member_id'=>$member->id,
            ])->create();
        }
    }
}
