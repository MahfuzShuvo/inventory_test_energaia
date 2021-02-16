<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supplier');
    }

    public function index()
    {
    	$products = Product::all();
        return view('supplier.home', compact('products'));
    }
}
