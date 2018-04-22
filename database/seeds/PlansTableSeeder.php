<?php

use App\Repositories\PaypalWebProfileRepository;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webProfiles = app(PaypalWebProfileRepository::class)->all();
        factory(\App\Models\Plan::class,1)->states(
            \App\Models\Plan::DURATION_MONTHLY
        )->create([
            'paypal_web_profile_id' => $webProfiles->random()->id
        ]);
        factory(\App\Models\Plan::class,1)->states(
            \App\Models\Plan::DURATION_YEARLY
        )->create([
            'paypal_web_profile_id' => $webProfiles->random()->id
        ]);
    }
}
