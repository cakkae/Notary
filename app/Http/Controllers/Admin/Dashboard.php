<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\ProductType;
use Validator;

class Dashboard extends Controller
{
    public function index() 
    {
        return view('admin.dashboard.index');
    }

    public function productType()
    {
        $productTypes = ProductType::paginate(10);
        return view('admin.dashboard.productType', ['productTypes' => $productTypes]);
    }

    public function addProductType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()->first()]);
        }

        try {

            $productType = new ProductType;
            $productType->name = $request->name;
            $productType->save();
            return response()->json(['success'=>'Product type successfully created.']);

        } catch (Exception $e) {
            return response()->json(['error'=> $e.getMessage()]);
        }
    }

    public function deleteProductType($product_id) {
        try {
            ProductType::destroy($product_id);
            return response()->json(['success'=>'Product type successfully deleted.']);
       } catch (Exception $e) {
            return response()->json(['error'=> 'Error while deleting product type =>'.$e]);
       }
    }
     
}
