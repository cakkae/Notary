<?php

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization = new Organization;
        $organization->company_info = "NotaryVM INC";
        $organization->company_contact = "Dijan Avdic";
        $organization->company_phone = "";
        $organization->company_email = "";
        $organization->company_address = "";
        $organization->save();
    }
}
