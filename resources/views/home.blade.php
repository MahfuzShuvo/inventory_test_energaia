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
        .pro-img img {
            width: 100%;
        }
        .product-content h5 {
            font-size: 15px;
            font-weight: 600;
            margin-top: 10px;
            color: #0c0525;
            transition: all .3s ease-in;
            cursor: pointer;
        }
        .product-content h5:hover {
            color: #6cb2eb;
        }
        .product-content p {
            margin-top: 10px;
            font-size: 13px;
            text-align: justify;
        }
        .pro-footer {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    All Products
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="product-content">
                                            <div class="pro-img">
                                                <img src="{{ asset($product->image) }}">
                                            </div>
                                            <div class="pro-footer">
                                                <h5>{{ $product->name }}</h5>
                                                <p style="color: #3490dc;">{{ $product->price }} &#2547;</p>
                                            </div>
                                            <div class="pro-desc">
                                                <p>
                                                    {{ $product->description }}
                                                </p>
                                            </div>
                                            <div class="supp">
                                                <p><b>Supplier Name: </b> {{ $product->supplier->name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    
    <script type="text/javascript">
        $(document).ready( function () {
            $('#productTable').DataTable();
        } );
    </script>
@endsection 