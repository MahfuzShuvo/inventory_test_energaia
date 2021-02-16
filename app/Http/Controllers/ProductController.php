<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use File;
use Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:supplier');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.product.add-product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validator  = \Validator::make($request->all(), [
            'name' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'required|mimetypes:image/jpeg, image/png, image/jpg|max:2048'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = new Product();

        $product->supplier_id = Auth::user()->id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = 0;

        $image = $request->file('image');

        $imagename = $image->getClientOriginalName();
        $imagesize = $image->getClientSize();
        $ext = $image->getClientOriginalExtension();

        $image_title = uniqid().time().'.'.$ext;
        $image->move('images/products/', $image_title);
        $product->image = "images/products/".$image_title;

        $product->save();

        session()->flash('success', 'Product added in the stock successfully');
        return redirect()->route('supplier.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('supplier.product.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $image = $request->file('image');
        if ($image) {
            if (File::exists($product->image)) {
                File::delete($product->image);
            }
        }

        $imagename = $image->getClientOriginalName();
        $imagesize = $image->getClientSize();
        $ext = $image->getClientOriginalExtension();

        $image_title = uniqid().time().'.'.$ext;
        $image->move('images/products/', $image_title);
        $product->image = "images/products/".$image_title;

        $product->save();

        session()->flash('success', 'Product updated successfully');
        return redirect()->route('supplier.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (File::exists($product->image)) {
            File::delete($product->image);
        }
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        return redirect()->back();
    }
}
