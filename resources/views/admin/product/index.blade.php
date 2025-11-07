@extends('layouts.app')
@section('content')
    <h5>Product Management</h5>
    <a href="{{route('admin.add-product')  }}" class="btn btn-primary">Add Product</a>
    <table class="table">
        <thead>
            <tr>
                <th>Sl</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_products as $item)
                 <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>
                        <div class="d-flex justify-content-space">

                            <a href="{{ route('admin.product.edit',[encrypt($item->id)]) }}">
                             <i class="bi bi-pencil-square"></i>
                        </a>
                            <a href="{{ route('admin.product.delete', [encrypt($item->id)]) }}" class="text-danger">
                                    <i class="bi bi-trash"></i>

                            </a>

                           
   
                        </div>
                        
                    </td>

                </tr>
            @endforeach
           
        </tbody>
    </table>
    <div class="mt-3">
        {{ $all_products->links('pagination::bootstrap-5') }}
    </div>
@endsection