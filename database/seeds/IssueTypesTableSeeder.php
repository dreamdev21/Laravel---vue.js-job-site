<?php

use Illuminate\Database\Seeder;
use  App\TheBetaPlan\Data\DataProvider;
use App\Models\IssueTypes;

class IssueTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataProvider::IssueTypes()->each(function($issueType){
            IssueTypes::create([ 'name' => $issueType ]);
        });
    }
}
