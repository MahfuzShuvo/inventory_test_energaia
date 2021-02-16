<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Supplier;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$products = Product::all();
        return view('admin.home', compact('products'));
    }

    public function users()
    {
    	$users = User::all();
        return view('admin.users', compact('users'));
    }

    public function suppliers()
    {
    	$suppliers = Supplier::all();
        return view('admin.suppliers', compact('suppliers'));
    }
}
