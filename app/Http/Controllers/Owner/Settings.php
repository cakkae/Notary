<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Company;
use Validator;
use Illuminate\Support\Facades\Hash;
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
            ->where('user_roles.role_id', '4')
            ->where('users.status', '1')
            ->get();
        } catch (Exception $ex) {

        }
        return view('owner.settings.index', ['organization' => $organization, 'users' => $users]);
    }

    public function updateSuperAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            $user = User::find($request->client_id);
            $user->name = $request->name;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->save();
            return response()->json(['success'=>'Super Admin successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    /*public function deleteSuperAdmin($user_id)
    {
        try {
            $user = User::find($user_id);
            $user->status = '0';
            $user->save();
            return back();
        }catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }*/

     public function deleteSuperAdmin($user_id)
    {
        try {
            $user = User::destroy($user_id);
            /*$user->status = '0';
            $user->save();*/
            return back();
        }catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
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
