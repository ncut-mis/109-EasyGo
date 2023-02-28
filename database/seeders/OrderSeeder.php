<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();//重製資料表
        $members=Member::all();//取得會員資料
        foreach ($members as $member){
            Order::factory(2,['member_id'=>$member->id])->create();
        }
    }
}
