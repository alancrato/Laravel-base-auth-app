<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootPath = config('filesystems.disks.videos_local.root');
        \File::deleteDirectory($rootPath,true);

        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(SerieTableSeeder::class);
        //$this->call(VideoTableSeeder::class);
        $this->call(PayPalWebProfilesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(SubscriptionsTableSeeder::class);
    }
}
