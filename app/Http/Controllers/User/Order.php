<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Role;
use App\User;
use App\Models\OrderDocuments;
use DataTables; 
use Validator;
use Auth;
use Mail;
use App\Mail\SendMail;
use App\Models\GeoData;

class Order extends Controller
{
    public function index(Request $request) {
        // if($request->ajax()) {
        //     $data = User::latest()->get();
        //     return DataTables::of($data)
        //             ->addColumn('action', function($data){
        //                 $button = '<button type="button"
        //                     name="select" id="'.$data->id.'"
        //                     class="select btn btn-primary
        //                     btn-sm">SELECT</button>';
        //                 return $button;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        $lastOrder = \App\Models\Order::latest()->first();
        $states = GeoData::select('state', 'state_id')->distinct()->get();
        $orders = \App\Models\Order::where('created_by', Auth::id())->get();

        $vendors = DB::table('users')
                    ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->where('user_roles.role_id','2')
                    ->get();

        return view('shared.orders.index', ['orders' => $orders, 'lastOrder' => $lastOrder, 'states' => $states, 'vendors' => $vendors]);
    }

    public function addDocuments(Request $request) {

        $files = [];

        foreach ($request->file('order_document') as $key => $file) {
            if(!empty($file)){
                try {
                    $otherDocumentName = $file->getClientOriginalName();
                    $file->move(
                    base_path().'/public/images/', $otherDocumentName);
                    OrderDocuments::create([
                        'name' => $otherDocumentName,
                        'order_id' => $request->document_order_id
                    ]);
                    \App\Models\Order::where('order_id', $request->document_order_id)->update(array('document_status' => '1'));
                } catch (Throwable $e) {
                    report($e);
                    return false;
                }
            }
        }
        
        $output = array(
            'success' => 'Document uploaded successfully'
        );

       return response()->json($output);
    }

    public function getAllDocumentsByOrder($order_id) {
        $documents = OrderDocuments::select("*")
                    ->where("order_id",$order_id)
                    ->get();
        return response()->json($documents);  
    }

    public function deleteDocument($document_id) {
        try {
            OrderDocuments::destroy($document_id);
            return response()->json(['success'=>'Document successfully deleted.']);
       } catch (Exception $e) {
            return response()->json(['error'=> 'Error while deleting document =>'.$e]);
       }
    }

	function send_order_email(Request $request) {
        try {
            Mail::to($request->email)->send(new SendMail($request));
            \App\Models\Order::where('order_id', $request->order)->update(array('document_status' => '2'));
            return response()->json(['success'=>'Email sent']);
       } catch (Exception $e) {
            return response()->json(['error'=> 'Error while sending email']);
       }

        
    }

    public function create(Request $request) {
                      
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|unique:order|max:255',
            'loan_id' => 'required|numeric',
            'file_id' => 'required',
            'property_location_street_name' => 'required',
            'property_location_additional_street_name' => 'required',
            'property_location_city' => 'required',
            'property_location_state' => 'required',
            'property_location_zip' => 'required',
            'close_location_street_name' => 'required',
            'close_location_additional_street_name' => 'required',
            'close_location_city' => 'required',
            'close_location_state' => 'required',
            'close_location_zip' => 'required',
            'borrower_name' => 'required',
            'borrower_middle_name' => 'required',
            'borrower_last_name' => 'required',
            'borrower_email' => 'required|email',
            'contact_number_home' => 'required|numeric',
            'closing_time_and_date' => 'required|date',
            'closing_type' => 'required',
            'lo_name' => 'required',
            'lo_email' => 'required|email',
            'lo_number' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {
            $input = $request->all();
            $order = \App\Models\Order::create($input);
            return response()->json(['success'=>'Order successfull created.']);
       } catch (Exception $e) {
            return response()->json(['error'=> 'BLA']);
       }

    }
}
