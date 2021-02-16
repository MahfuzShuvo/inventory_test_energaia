<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    public function index()
    {
    	$products = Product::where('supplier_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('supplier.home', compact('products'));
    }
}
