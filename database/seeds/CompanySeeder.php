<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $company = new Company;
        $company->company_name = "No1Company";
        $company->contact_name = "Adnan Beganovic";
        $company->contact_number = "+387 62 604 510";
        $company->email = "beganovicadnan95@gmail.com";
        $company->company_city = "Gracanica";
        $company->company_address = "Sarajevska 7";
        $company->save();

        $company = new Company;
        $company->company_name = "USA";
        $company->contact_name = "Dijan Avdic";
        $company->contact_number = "+387 62 604 510";
        $company->email = "davdic@gmail.com";
        $company->company_city = "New York";
        $company->company_address = "New York";
        $company->save();
        
    }
}
