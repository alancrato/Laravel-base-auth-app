<?php

use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = app(UserRepository::class)->all();
        $orders = factory(\App\Models\Order::class,10)->make();
        $orders->each(function ($order) use($users){
            $order->user_id = $users->random()->id;
            $order->save();
        });
    }
}
