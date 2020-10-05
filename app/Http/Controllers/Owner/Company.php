<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class Company extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = \App\Models\Company::all();
        return view('owner.company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.company.create');
    }

    
    public function updateFee(Request $request) 
    {
                    
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            \App\Models\Company::where('id', $request->company_id)->update(array('feeQuantityRange' => $request->feeQuantityRange));
            return response()->json(['success'=>'Company fee successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }

    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required|numeric',
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
            $user->middleName = $request->middleName;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->company_id = $request->company_id;
            $user->save();

            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $request->role_id
            ]);
            
            return response()->json(['success'=>'User successfully created.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function createSuperAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        } 

        try {
            $user = new User();
            $user->name = $request->name;
            $user->lastName = $request->surname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->company_id = 1;
            $user->save();
            $user_id = $user->id;

            DB::table('user_roles')->insert([
                'user_id' => $user_id,
                'role_id' => '4'
            ]);

            return response()->json(['success'=>'Super Admin successfully created.']);

        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email',
            'company_address' => 'required',
            'company_city' => 'required',
            'company_state' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            $input = $request->all();
            \App\Models\Company::create($input);
            return response()->json(['success'=>'Company successfully created.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function edit($id)
    {
        $company = \App\Models\Company::findOrFail($id);
        try {
            $users = User::where('company_id', $id)->where('status', '1')->paginate(10);
        } catch (Exception $ex) {

        }
        return view('owner.company.edit', ['company' => $company, 'users' => $users]);
    }

    public function deleteUser($user_id)
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

    public function updateRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
                DB::table('user_roles')
                    ->where('user_id', $request->user_id)
                    ->update(['role_id' => $request->role_id]);
            return response()->json(['success'=>'Permissions successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastName' => 'required',
            'phone' => 'required|numeric',
            'role_id' => 'required',
            'email' => 'required|email|max:255|unique:users,email,'.$request->user_id.',id' 
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            User::where('id', $request->company_id)->update(
                array(
                    'name' => $request->name,
                    'lastName' => $request->lastName,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'middleName' => $request->middleName,
                    'company_id' => $request->company_id
                ));
                DB::table('user_roles')
                    ->where('user_id', $request->user_id)
                    ->update(['role_id' => $request->role_id]);
            return response()->json(['success'=>'User details successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|max:255',
            'company_name' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email',
            'company_address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            \App\Models\Company::where('id', $request->company_id)->update(
                array(
                    'company_name' => $request->company_name,
                    'contact_name' => $request->contact_name,
                    'contact_number' => $request->contact_number,
                    'email' => $request->email,
                    'company_address' => $request->company_address,
                    'company_state' => $request->company_state,
                    'company_city' => $request->company_city,
                    'company_zip' => $request->company_zip
                ));
            return response()->json(['success'=>'Company details successfully updated.']);
        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
