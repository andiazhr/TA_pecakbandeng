@extends('itsfood.index')
@section('content')
<br><br><br>
<div class="container mb-2">
    <div class="col-sm-8 col-md-7 col-xl-6 mx-auto card border-primary p-4">
        <h5 class="card-header primary-col white-text text-center py-3">
            <strong>Edit Profile</strong>
        </h5>
        <form action="{{ route('removephoto', auth('pelanggan')->user()->id_pelanggan) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group" hidden>
            <label for="exampleInputPhoto1">Photo Profile</label><br>
            <input type="file" id="foto_profil" aria-describedby="fotoHelp" name="foto_profil[]">
        </div>
        <div class="form-row mb-4" hidden>
            <div class="col">
                <label for="exampleInputFirstName1">Name</label>
                <input type="text" class="form-control" id="nama_pelanggan" required aria-describedby="firstnameHelp" name="nama_pelanggan" value="{{ auth('pelanggan')->user()->nama_pelanggan }}" placeholder="Enter first name">
            </div>
            <div class="col">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" required aria-describedby="usernameHelp" name="username" value="{{ auth('pelanggan')->user()->username }}" placeholder="Enter username">
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group" hidden>
            <label for="exampleInputEmail1">Email Address</label>
            <input type="email" class="form-control" id="email_pelanggan" required aria-describedby="emailHelp" name="email_pelanggan" value="{{ auth('pelanggan')->user()->email_pelanggan }}" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group" hidden>
            <label for="exampleInputPhone1">Phone Number</label>
            <input type="number" class="form-control" id="phone_number" required aria-describedby="phoneHelp" name="phone_number" value="{{ auth('pelanggan')->user()->phone_number }}" placeholder="Enter phone number">
        </div>
        <div class="form-group" hidden>
            <label for="exampleInputPhone1">Bio</label><br>
            <textarea name="bio"class="form-control" rows="3">{{ auth('pelanggan')->user()->bio }}</textarea>
        </div>
        <div class="form-group">
            <div class="row no-gutters">
                <div class="col-12 d-flex justify-content-center">
                    <label for="exampleInputFoto1">Current Photo Profile</label>
                </div>
                @if(auth('pelanggan')->user()->foto_profil == NULL)
                <div class="col-12 d-flex justify-content-center">
                    <div class="rounded mb-2 imagePlaceholder">
                        <div class="mountain1"></div>
                        <div class="mountain2"></div>
                        <div class="sun"></div>
                    </div>
                </div>
                @else
                <div class="col-12 d-flex justify-content-center">
                    <img class="profil mb-2" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="150px" height="150px">
                </div>
                @endif
                <div class="col-12 d-flex justify-content-center">
                    <button onclick="return confirm('Yakin ingin menghapus foto profil?')" class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i> Remove Photo</button>
                </div>
            </div>
        </div>
        </form>
        <form role="form" method="post" action="{{ route('editprofile.submit', auth('pelanggan')->user()->id_pelanggan) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleInputPhoto1">Photo Profile</label><br>
            <input type="file" id="foto_profil" aria-describedby="fotoHelp" name="foto_profil[]">
        </div>
        <div class="form-row mb-4">
            <div class="col">
                <label for="exampleInputFirstName1">Name</label>
                <input type="text" class="form-control" id="nama_pelanggan" required aria-describedby="firstnameHelp" name="nama_pelanggan" value="{{ auth('pelanggan')->user()->nama_pelanggan }}" placeholder="Enter first name">
            </div>
            <div class="col">
                <label for="exampleInputUsername1">Username</label>
                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" required aria-describedby="usernameHelp" name="username" value="{{ auth('pelanggan')->user()->username }}" placeholder="Enter username">
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="email" class="form-control" id="email_pelanggan" required aria-describedby="emailHelp" name="email_pelanggan" value="{{ auth('pelanggan')->user()->email_pelanggan }}" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPhone1">Phone Number</label>
            <input type="number" class="form-control" id="phone_number" required aria-describedby="phoneHelp" name="phone_number" value="{{ auth('pelanggan')->user()->phone_number }}" placeholder="Enter phone number">
        </div>
        <div class="form-group">
            <label for="exampleInputPhone1">Bio</label><br>
            <textarea name="bio"class="form-control" rows="3">{{ auth('pelanggan')->user()->bio }}</textarea>
        </div>
        <center>
            <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Edit</button>
            <a href="{{ url('itsfood/profile', auth('pelanggan')->user()->id_pelanggan) }}"><button type="button" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button></a>
        </center>
        </form>
    </div>
</div>
@endsection