<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;

class Settings extends Controller
{
    public function index() 
    {
        try {
            $organization = \App\Models\Organization::all();
            $users = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.*')
            ->get();
        } catch (Exception $ex) {

        }
        return view('owner.settings.index', ['organization' => $organization, 'users' => $users]);
    }

    public function updateOrganization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_info' => 'required|max:255',
            'company_contact' => 'required|max:255',
            'company_email' => 'email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            \App\Models\Organization::where('id', '1')->update(
                array(
                    'company_info' => $request->company_info,
                    'company_contact' => $request->company_contact,
                    'company_phone' => $request->company_phone,
                    'company_email' => $request->company_email,
                    'company_address' => $request->company_address
                ));
            return response()->json(['success'=>'Organization information successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }
}
