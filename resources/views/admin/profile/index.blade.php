@extends('layouts.starlight')

@section('profile')
    active
@endsection
@section('title')
    Profile
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
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Name</h3>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{url('profile/namechange')}}" method='POST'>
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input name='name' type="text" class="form-control" value='{{Auth::user()->name}}'>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Password</h3>
                        </div>
                        @if(session('passsuccess'))
                            <div class="alert alert-success">
                                {{session('passsuccess')}}
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{url('profile/passchange')}}" method='POST'>
                                @csrf
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <input name='old_password' type="password" class="form-control">
                                    @if(session('wrong_pass'))
                                        <div class="alert alert-danger">
                                            {{session('wrong_pass')}}
                                        </div>
                                    @endif
                                    @error('old_password')
                                        <strong class='text-danger'>{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input name='password' type="password" class="form-control">
                                    @error('password')
                                        <strong class='text-danger'>{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input name='password_confirmation' type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Profile Photo</h3>
                        </div>
                        @if(session('passsuccess'))
                            <div class="alert alert-success">
                                {{session('passsuccess')}}
                            </div>
                        @endif
                        <div class="card-body">
                            <form action="{{url('profile/photochange')}}" method='POST' enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <p>Your Photo</p>
                                    <img class="w-25" src="{{asset('uploads/profile')}}/{{Auth::user()->profile_photo}}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">Profile Photo</label>
                                    <input name='profile_photo' type="file" class="form-control" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    <img class="w-50" class="py-2" id="pic" />
                                    @error('profile_photo')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
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