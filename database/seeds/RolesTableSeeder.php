<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => Role::ADMIN]);
        Role::create(['name' => Role::TESTER]);
        Role::create(['name' => Role::PUBLISHER]);
    }
}
