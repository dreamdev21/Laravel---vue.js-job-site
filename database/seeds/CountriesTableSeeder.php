<?php

use Illuminate\Database\Seeder;
use App\TheBetaPlan\Data\DataProvider;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataProvider::Countries()->each(function($row){
            Country::create($row);
        });
    }
}
