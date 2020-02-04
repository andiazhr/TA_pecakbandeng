@extends('itsfood.index')
@section('content')
<br><br><br>
<div class="container mb-2">
    <div class="col-sm-8 col-md-7 col-xl-6 mx-auto card border-primary p-4">
        <h5 class="card-header primary-col white-text text-center py-3">
            <strong>Sign up</strong>
        </h5>
        <form action="{{ route('daftar.submit')}}" method="post">
        @csrf
        <div class="form-row mb-4">
            <div class="col">
            <label for="exampleInputFirstName1">Name</label>
            <input type="text" class="form-control{{ $errors->has('nama_pelanggan') ? ' is-invalid' : '' }}" id="nama_pelanggan" autofocus required aria-describedby="firstnameHelp" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" placeholder="Enter first name">
            @if ($errors->has('nama_pelanggan'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_pelanggan') }}</strong>
                </span>
            @endif
            </div>
            <div class="col">
            <label for="exampleInputUsername1">Username</label>
            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" required aria-describedby="usernameHelp" name="username" value="{{ old('username') }}" placeholder="Enter username">
            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            <input type="email" class="form-control{{ $errors->has('email_pelanggan') ? ' is-invalid' : '' }}" id="email_pelanggan" required aria-describedby="emailHelp" name="email_pelanggan" value="{{ old('email_pelanggan') }}" placeholder="Enter email">
            @if ($errors->has('email_pelanggan'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email_pelanggan') }}</strong>
                </span>
            @endif
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPhone1">Phone Number</label>
            <input type="number" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="phone_number" required aria-describedby="phoneHelp" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter phone number">
            @if ($errors->has('phone_number'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" minlength="8" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" required name="password" placeholder="Password">
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Re-enter Password</label>
            <input type="password" minlength="8" class="form-control" name="password_confirmation" id="password" required placeholder="Re-enter password">
        </div>
        <div class="form-group">
            <label class="switch">
                <input type="checkbox" id="checkpersetujuan">
                <span class="slider round"></span>
            </label>
            <a class="badge badge-warning" href="#" data-toggle="modal" data-target="#persetujuan"><h6>Baca Persetujuan</h6></a>

            <div class="modal fade" id="persetujuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <center>
            <button type="submit" id="daftar" class="btn btn-primary" onclick="return Validate()">Register</button>
            <a href="{{ url('itsfood') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
        </center>
        </form>
        <center>
            <div class="col-12 pt-3">
            <a href="{{ route('masuk') }}"><button type="button" class="btn btn-success">I already have an account</button></a>
            </div>
        </center>
    </div>
</div>
@endsection