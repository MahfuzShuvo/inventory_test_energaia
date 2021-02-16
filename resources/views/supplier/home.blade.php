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
                    All Products
                    <div class="links">
                        <a href="{{ route('product.create') }}">+ Add</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="productTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @php
                            $num = 1;
                        @endphp
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <div class="product-image">
                                            <img src="{{ asset($product->image) }}">
                                        </div>
                                    </td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }} &#2547;</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @if ($product->status == 1)
                                            <span class="badge bg-success" style="color: #fff; padding: 4px 8px; font-size: 10px;">Approved</span>
                                        @endif
                                        @if ($product->status == 0)
                                            <span class="badge bg-danger" style="color: #fff; padding: 4px 8px; font-size: 10px;">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-icons">
                                            <a href="{{ route('product.edit', $product->id) }}"><i class='bx bxs-edit' ></i></a>
                                            <a href="#deleteModal{{ $product->id }}" data-toggle="modal"><i class='bx bx-trash' ></i></a>

                                            <!-- Delete Modal start -->
                                            <div class="modal fade" tabindex="-1" id="deleteModal{{ $product->id }}">
                                                <div class="modal-dialog modal-dialog-top" role="document">
                                                    <div class="modal-content">
                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                            <em class="icon ni ni-cross"></em>
                                                        </a>
                                                        <div class="modal-header">
                                                            <h6 class="modal-title">Are you sure to delete?</h6>
                                                        </div>
                                                        {{-- <div class="modal-body">
                                                            
                                                        </div> --}}
                                                        <div class="modal-footer">
                                                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-info btn-sm" style="font-size: 12px;">YES, delete permanently</button>
                                                            </form>
                                                            <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal" style="font-weight: 400; font-size: 12px;">NO</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Delete Modal end -->
                                        </div>
                                    </td>
                                </tr>
                                
                                @php
                                    $num++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
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