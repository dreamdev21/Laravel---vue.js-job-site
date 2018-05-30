<?php

use Illuminate\Database\Seeder;
use App\Models\ProjectType;
use App\TheBetaPlan\Data\DataProvider;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataProvider::ProjectType()->each(function($pName){
            ProjectType::create([
               'name' => $pName,
               'status' => 'active'
            ]);
        });
    }
}
