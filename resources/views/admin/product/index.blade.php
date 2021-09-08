@extends('layouts.starlight')

@section('products')
    active
@endsection
@section('title')
product
@endsection

@section('content')
@include('layouts.nav')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Dashboard</a>
    </nav>
    <div class="sl-pagebody">
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Added Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Product Name</th>
                                <th>Product price</th>
                                <th>Product Description</th>
                                <th>Product Quantity</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{App\Models\Category::find($product->category_id)->category_name}}</td>
                                <td>{{App\Models\Subcategory::find($product->subcategory_id)->subcategory_name}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_price}}</td>
                                <td>{{$product->product_desp}}</td>
                                <td>{{$product->product_quantity}}</td>
                                <td>
                                    <img width="50" src="{{asset('uploads/product')}}/{{$product->product_image}}" alt="">
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Product</h3>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{url('/product/insert')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group mb-3">
                            <label for="">Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="">--select category--</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Subcategory</label>
                                <select class="form-control" name="subcategory_id">
                                    <option value="">--select subcategory--</option>
                                    @foreach($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" name="product_name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Price</label>
                                <input type="text" class="form-control" name="product_price">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Description</label>
                                <textarea name="product_desp" class="form-control"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product Quantity</label>
                                <input type="text" class="form-control" name="product_quantity">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Product image</label>
                                <input type="file" class="form-control" name="product_image">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection