@extends('itsfood.index')
@section('content')
<br><br><br>
<div class="container mb-2">
    @if(session()->get('fail'))
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-danger">
                    {{ session()->get('fail') }} <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @endif
    @if(session()->get('login'))
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-primary">
                    {{ session()->get('login') }} <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @endif
    <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4 mx-auto card border-primary p-4">
        <h5 class="card-header primary-col white-text text-center py-3">
            <strong>Sign in</strong>
        </h5>
        <form action="{{ route('masuk.submit')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email_pelanggan" aria-describedby="emailHelp" placeholder="Enter email" autofocus>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <center>
            <button type="submit" class="btn btn-primary">Login</button>
        </center>
        </form>
        <center>
            <div class="col-12 pt-3">
            <a href="{{ route('daftar') }}"><button type="button" class="btn btn-warning">I don't have an account</button></a>
            </div>
        </center>
    </div>
</div>
@endsection