<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillsAndExperience extends Controller
{
    public function index() 
    {
        return view('vendor.skills_and_experience.index');
    }
}
