<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product_list.product', compact('products'));
    }

    public function placeOrder(Request $request)
    {

       // Validate the request data
    $validator = Validator::make($request->all(), [
        'customer_name' => 'required',
        'mobile_number' => 'required',
        'email'=>'required',
        'address'=>'required',
        'city'=>'required',
        'state'=>'required',
        'pincode'=>'required',
        // Add validation rules for other fields
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

      

    // Create or update customer information
 
    $customer = Customer::Create(

        [
            'customer_name' => $request->input('customer_name'),
            'mobile_number' => $request->input('mobile_number'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
        ]
    );  
    //  dd($customer);
  
    

        // Logic to save order or display a confirmation message

        return redirect()->route('product')->with('success', 'Customer details submitted successfully!');
    }
}


