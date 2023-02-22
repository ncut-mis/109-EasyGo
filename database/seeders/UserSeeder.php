<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Member;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        User::truncate();//重制資料表
        Admin::truncate();//重制資料表
        Member::truncate();//重制資料表
        //平台人員(身分編碼為2
        User::factory([
            'type'=> 2,//身分編號
            'name' => 'admin',//姓名
            'email' => 'admin@gmail.comm',//電子郵件
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->has(Admin::factory(1))->create();
        //會員(身分編碼為1
        User::factory([
            'type'=> 1,//身分編號
            'name' => 'member',//姓名
            'email' => 'member@gmail.comm',//電子郵件
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->has(Member::factory(1))->create();

        User::factory(20)->has(Member::factory(1))->create();
    }
}
