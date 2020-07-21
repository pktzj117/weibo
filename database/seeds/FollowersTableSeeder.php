<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // 获取除掉 ID 为 1的 所以用户ID数组
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        //关注 除了1 号用户意外的所有永华
        $user->follow($follower_ids);

        //除了 1号外的所有用户都来关注1号用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
