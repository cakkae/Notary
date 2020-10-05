<?php

use Illuminate\Database\Seeder;
use \App\Models\GeoData;
use JeroenZwart\CsvSeeder\CsvSeeder;

class GeodataSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/CSV/geo-data.csv';
        $this->delimiter = ",";
        $this->mapping = ['state_id', 'state', 'state_abbr', 'zipcode', 'country', 'city'];
        $this->header = FALSE;
        $this->tablename = 'geodata';
    }

    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
