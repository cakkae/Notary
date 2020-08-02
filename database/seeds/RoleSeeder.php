<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = "User";
        $role->save();

        $role = new Role;
        $role->name = "Vendor";
        $role->save();

        $role = new Role;
        $role->name = "Admin";
        $role->save();

        $role = new Role;
        $role->name = "Owner";
        $role->save();

        $role = new Role;
        $role->name = "Client";
        $role->save();
    }
}
