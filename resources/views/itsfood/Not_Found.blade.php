@extends('itsfood.index')
@section('content')

@if( Request::segment(2) == 'search')
<div class="col-12 d-flex justify-content-center pt-3 text-secondary">
    <h3 style="font-family: raleway">Your Result Is Not Available Yet ->&nbsp;<p style="color:#ffd700; float:right;">{{ app('request')->input('search') }}</p></h3>
</div>
@else
<div class="col-12 d-flex justify-content-center pt-3 text-secondary">
    <div class="row no-gutters">
        <div class="col-12 d-flex justify-content-center">
            <h3 style="font-family: raleway">Your Request Detail Produk Is Not Found</h3>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <p style="font-size: 17px">
                <a href="/itsfood" class="text-decoration-none text-warning">ItsFood</a>
                &#155; 
                Detail Produk
                &#155; 
                {{ Request::segment(3) }}
            </p>
        </div>
    </div>
</div>
@endif

<div class="row no-gutters d-flex justify-content-center">
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center p-5" style="height:400px;">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 pt-5 text-center" style="margin-top: 50px;">
            <h3 style="font-family: raleway;">404 Not Found</h3>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 d-flex justify-content-center p-5" style="height:400px;">
        <img src="{{ asset ('/imageforuser/error-4042.png') }}" alt="Jet" style="width:256px;height:256px;">
    </div>
</div>
@endsection