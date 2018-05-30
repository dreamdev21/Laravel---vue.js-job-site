<?php

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\TheBetaPlan\Data\DataProvider;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataProvider::Devices()->each(function($dName){
           Device::create([
               'name' => $dName,
               'status' => 'active'
           ]);
        });
    }
}
