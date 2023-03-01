<?php

namespace Database\Seeders;

use App\Models\Collect;
use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collect::truncate();//重製資料表
        $members = Member::all();//會員資料
        foreach ($members as $member) {
            Collect::factory(2, ['member_id' => $member->id])->create();
        }
    }
}
