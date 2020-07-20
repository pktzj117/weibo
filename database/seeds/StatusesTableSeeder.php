<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = ['1','2','3'];
        $faker = app(Faker\Generator::class);

        $statuses =
        // 工厂模式，构建一个 Status 类的工厂
        factory(Status::class)
        // 打算构建 100 条数据，每条数据是一个 Status 实例
        ->times(100)
        // 执行（此处返回的应该是一个 Collection 集合对象）
        ->make()
        // 针对每条数据进行操作
        ->each(function ($status) use ($faker, $user_ids){
            // 每条记录的 user_id 从 $user_ids 数组中随机取
            $status->user_id = $faker->randomElement($user_ids);
        });

        Status::insert($statuses->toArray());
    }
}
