<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(user::class)->times(50)->make();
        User::insert($users->makeVisible(['password', 'remeber_token'])->toArray());

        $user = User::find(1);
        $user->name = '狗翔';
        $user->email = '416335127@qq.com';
        $user->is_admin = true;
        $user->save();
    }
}
