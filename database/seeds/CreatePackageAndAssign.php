<?php

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\User;
use App\Models\Role;

class CreatePackageAndAssign extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = new Package();
        $package->name = 'Normal';
        $package->first_project_per_tester_charge = 40;
        $package->regular_per_tester_charge = 60;
        $package->discount_after_number_of_tester = 5;
        $package->discount_type = 1;
        $package->discount_amount = 5;
        $package->is_default = true;
        $package->save();
        User::role(Role::PUBLISHER)->update(['package_id' => $package->id]);
    }
}
