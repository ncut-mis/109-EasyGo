<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::truncate();//重制資料表
        $members = Member::all();//會員資料
        foreach ($members as $member) {
            Card::factory(2, ['member_id' => $member->id])->create();//每個會員新增兩張信用卡
        }
    }
}
