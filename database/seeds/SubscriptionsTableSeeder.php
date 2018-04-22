<?php

use App\Repositories\OrderRepository;
use App\Repositories\PlanRepository;
use App\Repositories\SubscriptionRepositoryEloquent;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = app(PlanRepository::class)->all();
        $orders = app(OrderRepository::class)->all();
        $repository = app(SubscriptionRepositoryEloquent::class);
        foreach (range(1, 20) as $element){
            $repository->create([
                'plan_id' => $plans->random()->id,
                'order_id' => $orders->random()->id
            ]);
        }
    }
}
