<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeoData;

class Coverage extends Controller
{
    public function index() 
    {
        $states = GeoData::select('state', 'state_id')->distinct()->get();
        return view('vendor.coverage.index', ["states" => $states]);
    }

    public function getCountry($state_id)
    {
        $country = GeoData::select("country")
                    ->where("state_id",$state_id)
                    ->distinct()
                    ->orderBy('country', 'asc')
                    ->get();
        return response()->json($country);    
    }

    public function getZipCode($country_name)
    {
        $zipcode = GeoData::select("zipcode")
                    ->where("country",$country_name)
                    ->distinct()
                    ->get();
        return response()->json($zipcode);    
    }

    public function update()
    {

    }
    
}
