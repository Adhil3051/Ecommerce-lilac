@extends('layouts.app')
@section('content')
    <div class="container justify-content-center mt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header ">
                        <h5 class="mb-0">Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.products.update',[encrypt($product->id)]) }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control"
                                        placeholder="Enter product name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="price" class="form-label">Price (₹)</label>
                                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" id="price" class="form-control"
                                        placeholder="Enter price">
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description"  rows="3" class="form-control"
                                    placeholder="Enter product description">{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" name="stock" id="stock"  value="{{ $product->stock }}" class="form-control"
                                    placeholder="Enter available stock">
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
