<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Company;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;

class Notary extends Controller
{
    public function index() 
    {
        return view('admin.notary.index');
    }

    public function notaries()
    {
        try {
            $notaries = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.*')
            ->where('user_roles.role_id', '2')
            ->get();
        } catch (Exception $ex) {

        }
        return view('admin.notary.index', ['notaries' => $notaries]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {

            $user = new User;
            $user->name = $request->name;
            $user->lastName = $request->lastName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->company_id = $request->company_id;
            $user->save();
            $user_id = $user->id;

            DB::table('user_roles')->insert([
                'user_id' => $user_id,
                'role_id' => '2'
            ]);
            
            return response()->json(['success'=>'Notary successfully created.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.notary.create', ['companies' => $companies]);
    }
}
