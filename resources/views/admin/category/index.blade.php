@extends('layouts.starlight')

@section('category')
    active
@endsection
@section('title')
    Category
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
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                </div>
                @if(session('delsuccess'))
                    <div class="alert alert-success">{{session('delsuccess')}}</div>
                @endif
                <div class="card-body">
                    <table class='table table-striped'>
                        <tr>
                            <th>SL No.</th>
                            <th>Category Name</th>
                            <th>Added By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{App\Models\User::find($category->added_by)->name}}</td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                            <td><a href="{{url('/category/delete')}}/{{$category->id}}" class="btn btn-danger">delete</a></td>
                        </tr>
                        @endforeach

                        @if($categories->count()==0)
                            <tr>
                                <td class='text-center' colspan='4'>No Date Found</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ url('/category/insert') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label">Category Name</label>
                          <input type="text" class="form-control" name="category_name">
                          @error('category_name')
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

</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
@endsection
