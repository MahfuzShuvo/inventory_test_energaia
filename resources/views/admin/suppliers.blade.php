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
        .links a.active {
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
        .content-header {
            text-align: center;
        }
        .content-header h5 {
            font-size: 20px;
            font-weight: 600;
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <div class="links">
                        <a class="{{ url()->current() == 'http://127.0.0.1:8000/suppliers' ? 'active' : '' }}" href="{{ route('suppliers') }}">Suppliers</a>
                        <a class="{{ url()->current() == 'http://127.0.0.1:8000/users' ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                        <a class="{{ url()->current() == 'http://127.0.0.1:8000/admin' ? 'active' : '' }}" href="{{ route('admin.home') }}">Products</a>
                    </div>
                </div>

                <div class="content-header">
                    <h5>All Suppliers</h5>
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
                                <th>Email</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        @php
                            $num = 1;
                        @endphp
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($supplier->created_at)->format('d/m/Y')}}</td>>
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