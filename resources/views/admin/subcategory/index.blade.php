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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Subcategory List</h3>
                    </div>
                    <div class="card-body">
                    <div class="div">
                        <input type="checkbox" id='checkAll'> Mark all
                    </div>
                        <form action="{{url('subcategory/markdelete')}}" method="POST">
                        @csrf
                        <table class="table table-striped">
                            <tr>
                                <th>Mark</th>
                                <th>SL</th>
                                <th>Subcategory Name</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @forelse($subcategories as $subcategory)
                            <tr>
                                <td><input class='checkItem' type="checkbox" name="marked_id[]" value="{{$subcategory->id}}"></td>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$subcategory->subcategory_name}}</td>
                                <td>{{App\Models\Category::find($subcategory->category_id)->category_name}}</td>
                                <td>
                                    @if($subcategory->created_at->diffInDays(\Carbon\Carbon::today()) > 30)
                                        {{$subcategory->created_at->format('d/m/y h:i:s')}}
                                    @else
                                        {{$subcategory->created_at->diffForHumans()}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('/subcategory/edit')}}/{{$subcategory->id}}" class="btn btn-success">Edit</a>
                                    <a href="{{url('/subcategory/delete')}}/{{$subcategory->id}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                                <tr><td>No Data Available</td></tr>
                            @endforelse
                        </table>
                            <button value='delete' name='delete' type="submit" class="btn btn-success">Delete Marked</button>
                            <button value='kamnai' name='kamnai' type="submit" class="btn btn-info">Kaj Kam Nai</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Trashed Subcategory List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Subcategory Name</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            @forelse($deleted_subcategories as $delete_subcategory)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$delete_subcategory->subcategory_name}}</td>
                                <td>{{App\Models\Category::find($delete_subcategory->category_id)->category_name}}</td>
                                <td>{{$delete_subcategory->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{url('/subcategory/restore')}}/{{$delete_subcategory->id}}" class="btn btn-success">Restore</a>
                                    <a href="{{url('/subcategory/perdelete')}}/{{$delete_subcategory->id}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                                <tr><td>No Data Available</td></tr>
                            @endforelse
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Subcategory</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        @if(session('subcategory_exist'))
                            <div class="alert alert-danger">
                                {{session('subcategory_exist')}}
                            </div>
                        @endif
                    <form action="{{url('/subcategory/insert')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                        <label class="form-label">Category List</label>
                            <select name="category_id" class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach($categories as $category)
                                    <option {{old('category_id') == $category->id?'selected':''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger my-3">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subcategory Name</label>
                            <input value="{{old('subcategory_name')}}" type="text" class="form-control" name="subcategory_name">
                            @error('subcategory_name')
                            <div class="alert alert-danger my-3">
                                {{$message}}
                            </div>
                            @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection

@section('footer_script')
    <script>
        $('#checkAll').click(function () {    
            $(':checkbox.checkItem').prop('checked', this.checked);    
        });
    </script>
@endsection