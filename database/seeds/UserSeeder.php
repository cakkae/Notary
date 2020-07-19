<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$role_user = Role::where('name', 'User')->first();
        $role_vendor  = Role::where('name', 'Vendor')->first();
        $role_admin  = Role::where('name', 'Admin')->first();*/

        $user = new User;
        $user->name = "Adnan";
        $user->lastName = "Beganovic";
        $user->email = "beganovicadnan95@gmail.com";
        $user->phone = "38762604510";
        $user->password = Hash::make('internet');
        $user->company_id = 1;
        $user->save();

        $user = new User;
        $user->name = "Dijan";
        $user->lastName = "Avdic";
        $user->email = "dijan@gmail.com";
        $user->phone = "38762604510";
        $user->password = Hash::make('internet');
        $user->company_id = 2;
        $user->save();

        DB::table('user_roles')->insert([
            'user_id' => '1',
            'role_id' => '4'
        ]);

        DB::table('user_roles')->insert([
            'user_id' => '2',
            'role_id' => '3'
        ]);
    }
}
