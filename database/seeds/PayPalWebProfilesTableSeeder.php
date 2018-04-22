<?php

use Illuminate\Database\Seeder;

class PayPalWebProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\PaypalWebProfile::class,2)->create();
    }
}
