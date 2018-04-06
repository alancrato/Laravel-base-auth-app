<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class,2)
            ->states('admin')
            ->create()->each(function ($user){
                $user->verified = false;
                $user->save();
            });
    }
}
