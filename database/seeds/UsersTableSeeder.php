<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(User::class)->create(['first_name' => 'admin', 'email' => 'admin@thebetaplan.com', 'password' => bcrypt('admin123')]);
        $admin->assignRole(Role::admin());
        $admin->setStatus(Status::ACTIVE);
//        $tester = factory(User::class)->create([ 'first_name' => 'tester1', 'email' => 'tester1@thebetaplan.com', 'password' => bcrypt('tester123')]);
//        $tester->assignRole(Role::tester());
//        $tester->setStatus(Status::PENDING_ACTIVATION);
//        $publisher = factory(User::class)->create([ 'first_name' => 'publisher01', 'email' => 'publisher01@thebetaplan.com', 'password' => bcrypt('p123')]);
//        $publisher->assignRole(Role::publisher());
//        $publisher->setStatus(Status::PENDING_ACTIVATION);
    }
}
