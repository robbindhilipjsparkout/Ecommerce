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
        // dd($request->all());
  
    $customer = Customer::Create(

        [
            'customer_name' => $request->input('customer_name'),
            'mobile_number' => $request->input('mobile_number'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'total_amount' => $request->input('total'),
            
        ]);  

        
 
        return redirect()->route('product')->with('success', 'Customer details submitted successfully!');
    }
}


