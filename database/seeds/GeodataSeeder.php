<?php

use Illuminate\Database\Seeder;
use \App\Models\GeoData;

class GeodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $geodata = new GeoData;
        $geodata->state_id = 1;
        $geodata->state = "Alabama";
        $geodata->state_abbr = "AL";
        $geodata->zipcode = 35004;
        $geodata->country = "St. Clair";
        $geodata->city = "Acmar";
        $geodata->save();
    }
}
