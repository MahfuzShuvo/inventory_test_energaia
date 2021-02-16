@extends('layouts.app')

@section('style')
    <style type="text/css">
        .links a {
            border: 1px solid #fff;
            padding: 5px 20px;
            border-radius: 3px;
            color: #fff;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: all .3s ease-in;
        }
        .links a:hover {
            background: #fff;
            color: #0c0525;
        }
        .action-icons a {
            font-size: 18px;
            color: #0c0525;
            transition: all .3s ease-in;
        }
        .action-icons a:not(last-child) {
            margin-right: 10px;
        }
        .action-icons a:hover {
            color: #6cb2eb;
        }
        table {
            font-size: 12px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #0c0525;
            color: #fff !important;
        }
        .product-image img {
            width: 80px;
        }
        .form-control {
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between;">
                    Edit Product
                    <div class="links">
                        <a href="{{ route('supplier.home') }}">View All</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    	@method('PUT')
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control"  name="name" value="{{ $product->name }}" placeholder="Product Name">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price" value="{{ $product->price }}" placeholder="Price">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}" placeholder="Quantity">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="description" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
                        </div>
                        <div class="product-image mb-2">
                        	<img src="{{ asset($product->image) }}">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection 