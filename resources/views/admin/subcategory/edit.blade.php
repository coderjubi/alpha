@extends('layouts.starlight')

@section('subcategory')
    active
@endsection

@section('title')
    subcategory
@endsection

@section('content')
@include('layouts.nav')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="#">Dashboard</a>
    </nav>
    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Subcategory</h3>
                        </div>
                        @if(session('update'))
                            <div class="alert alert-success">
                                {{session('update')}}
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{url('/subcategory/update')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name="subcategory_id" value="{{$subcategories->id}}">
                                    <label for="" class="form-label">Category List</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">--Select Category--</option>
                                        @foreach($categories as $category)
                                            <option {{$subcategories->category_id == $category->id?'selected': ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Subcategory Name</label>
                                    <input type="text" value="{{$subcategories->subcategory_name}}" name="subcategory_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection