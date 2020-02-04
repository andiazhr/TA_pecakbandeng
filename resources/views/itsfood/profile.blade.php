@extends('itsfood.index')
@section('content')
<br><br><br>
<div class="container mb-2">
    <div class="col-sm-8 col-md-7 col-xl-6 mx-auto card border-info p-4">
    <a href="{{ url('itsfood') }}"><button type="button" class="btn btn-warning float-right mb-3"><i class="fa fa-chevron-left"></i> Kembali</button></a>
        <h5 class="card-header primary-col white-text text-center py-3">
            <strong>Profile</strong>
        </h5>
        <div class="row">
            @if(auth('pelanggan')->user()->foto_profil == NULL)
            <div class="col-12 d-flex justify-content-center">
                <div class="rounded imagePlaceholder">
                    <div class="mountain1"></div>
                    <div class="mountain2"></div>
                    <div class="sun"></div>
                </div>
            </div>
            @else
            <div class="col-12 d-flex justify-content-center">
                <img class="profil mt-3" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="150px" height="150px">
            </div>
            @endif
            <div class="col-12 d-flex justify-content-center">
                <h2 class="mt-3">{{ auth('pelanggan')->user()->nama_pelanggan }}</h2>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <h5 class="mt-1"><span class="badge badge-warning"><i class="fa fa-mobile-alt"></i> {{ auth('pelanggan')->user()->phone_number }}</span></h5>
                &nbsp;
                <h5 class="mt-1"><span class="badge badge-danger"><i class="far fa-envelope"></i> {{ auth('pelanggan')->user()->email_pelanggan }}</span></h5>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <p class="">{{ auth('pelanggan')->user()->bio }}</p>
            </div>
            <div class="col-12">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-history"></i> Riwayat Pembelian
                </button>
                <a href="{{ route('editprofile', auth('pelanggan')->user()->id_pelanggan) }}">
                    <button class="btn btn-light btn-sm" type="button">
                        <i class="far fa-edit"></i> Edit Profile
                    </button>
                </a>
            </div>
            <div class="collapse col-12" id="collapseExample">
                <div class="card card-body border-info">
                    <h6 class="card-title">Riwayat Pembelian Menu</h6>
                    <ol>
                        @foreach($order as $history)
                            <li>{{$history->nama_produk}} <span class="badge badge-info float-right">{{$history->jumbel_produk}}</span></li>
                        @endforeach
                    </ol>
                    <h6 class="card-title">Riwayat Pembelian Lain</h6>
                    <ol>
                        @foreach($produk as $lain)
                            <li>{{$lain->nama_produk}} <span class="badge badge-info float-right">{{$lain->jumbel_produk}}</span></li>
                        @endforeach
                    </ol> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection