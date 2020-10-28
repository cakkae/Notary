<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Company;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class Users extends Controller
{
    public function index() 
    {
        return view('admin.users.index');
    }

    public function clients()
    {
        try {
            $clients = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.*')
            ->where('user_roles.role_id', '5')
            ->where('users.company_id', Auth::user()->company_id)
            ->where('users.status','1')
            ->get();
        } catch (Exception $ex) {

        }
        return view('admin.clients.index', ['clients' => $clients]);
    }

    public function users()
    {
        try {
            $users = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->select('users.*', 'user_roles.*')
            ->where('user_roles.role_id', '1')
            ->where('users.company_id', Auth::user()->company_id)
            ->where('users.status','1')
            ->get();
        } catch (Exception $ex) {

        }
        return view('admin.users.index', ['users' => $users]);
    }

    public function updateClientPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            $user = User::find($request->client_id);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['success'=>'Password successfully changed.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function updateUserPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            $user = User::find($request->user_id);
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['success'=>'Password successfully changed.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function deleteClient($user_id)
    {
        try {
            $user = User::find($user_id);
            $user->status = '0';
            $user->save();
            return back();
        }catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
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
                'role_id' => '5'
            ]);
            
            return response()->json(['success'=>'Client successfully created.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function storeUser(Request $request)
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
                'role_id' => '1'
            ]);
            
            return response()->json(['success'=>'User successfully created.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.clients.create', ['companies' => $companies]);
    }

    public function createUser()
    {
        $companies = Company::all();
        return view('admin.users.create', ['companies' => $companies]);
    }

    public function updateCurrentUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            User::where('id', $request->user_id)->update(
                array(
                    'name' => $request->name,
                    'lastName' => $request->lastName,
                    'phone' => $request->phone,
                    'middleName' => $request->middleName
                ));
                
            return response()->json(['success'=>'User details successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

}
