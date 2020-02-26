@extends('itsfood.index')
@section('content')
<div class="col-12 d-flex justify-content-center pt-3">
    <h3 style="font-family: raleway">Your Search Result &#155;&nbsp;<p style="color:#ffd700; float:right;">{{ app('request')->input('search') }}</p></h3>
</div>

<div class="row no-gutters">
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 p-0">
        <div class="row no-gutters">
            @foreach($hasil as $data)
            <?php $check = 0 ?>
            <?php $checkrating = 0 ?>
            <?php $checkeditrating = 0 ?>
            <?php $totaleditrating = 0 ?>
            <?php $checklike = 0 ?>
            <?php $checkreview = 0 ?>
            <?php $checkeditreview = 0 ?>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-3">
                <div class="card border-warning">
                    <div class="card-body">
                        <div class="row no-gutters">
                            <div class="col-6 col-xl-6 col-lg-8 col-md-6 col-sm-6">
                            <h5 class="card-title float-left">{{$data->nama_produk}}</h5>
                            </div>
                            <div class="col-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 mt-1">
                                @if($data->nama_kategori == 'Makanan')
                                <h6 class="card-title float-right"><span class="badge badge-danger">{{$data->nama_kategori}}</span></h6>
                                @elseif($data->nama_kategori == 'Minuman')
                                <h6 class="card-title float-right"><span class="badge badge-primary">{{$data->nama_kategori}}</span></h6>
                                @else
                                <h6 class="card-title float-right"><span class="badge badge-secondary">{{$data->nama_kategori}}</span></h6>
                                @endif
                            </div>
                            @if( auth('pelanggan')->check() )
                                @if($countrating == 0)
                                <div class="col-4 col-xl-4 col-lg-2 col-md-4 col-sm-4 pl-xl-0 pl-lg-3 pl-md-5 d-flex justify-content-center" style="margin-top: -8px">
                                        <a data-toggle="modal"
                                            data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                            data-idproduk="{{$data->id_produk}}" 
                                            data-namaproduk="{{$data->nama_produk}}" 
                                            href="#rating" 
                                            class="btn grow rating">
                                            <i class="fas fa-star fa-lg mr-1 text-dark"></i>3
                                        </a>
                                        <div class="modal fade" id="rating" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title float-left mr-2">Berikan Rating Menu</h5><h5 class="card-title float-left mt-1 text-warning" name="nama_produk" id="nama_produk"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="1"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="2"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="3"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="4"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="5"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach($rating as $star)
                                    @if($star->id_pelanggan == auth('pelanggan')->user()->id_pelanggan && $star->id_produk == $data->id_produk)
                                    <?php $checkrating++ ?>
                                    <div class="col-4 col-xl-4 col-lg-2 col-md-4 col-sm-4 pl-xl-0 pl-lg-3 pl-md-5 d-flex justify-content-center" style="margin-top: -6px">
                                        <a data-toggle="modal"
                                            data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                            data-idrating="{{$star->id_rating}}" 
                                            data-idproduk="{{$data->id_produk}}" 
                                            data-namaproduk="{{$data->nama_produk}}" 
                                            data-nilai="{{$star->nilai}}" 
                                            href="#rating" 
                                            class="btn grow rating">
                                            <i class="fas fa-star fa-lg mr-1 text-warning"></i>
                                            @foreach($ratingProduk as $starProduk)
                                                @if($starProduk->id_produk == $data->id_produk)
                                                    {{round(($starProduk->hasil+3)/($starProduk->total+1), 2)}}
                                                @endif
                                            @endforeach
                                        </a>
                                        <div class="modal fade" id="rating" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title float-left mr-2">Berikan Rating Menu</h5><h5 class="card-title float-left mt-1 text-warning" name="nama_produk" id="nama_produk"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="1"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="2"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="3"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="4"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="5"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                    <form role="form" method="post" action="{{route('delete.rating', $star->id_rating)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                        <button onclick="return confirm('Yakin ingin menghapus rating anda?')" type="submit" class="btn btn-danger">Hapus Review</button>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @if($checkrating == 0)
                                    <div class="col-4 col-xl-4 col-lg-2 col-md-4 col-sm-4 pl-xl-0 pl-lg-3 pl-md-5 d-flex justify-content-center" style="margin-top: -6px">
                                    @foreach($editRating as $editstar)
                                        @if($editstar->id_produk == $data->id_produk)
                                            <?php $checkeditrating++ ?>
                                            <a data-toggle="modal"
                                                data-starid="{{ $editstar->id_rating }}" 
                                                data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                                data-idproduk="{{$data->id_produk}}" 
                                                data-namaproduk="{{$data->nama_produk}}" 
                                                href="#ratingnew" 
                                                class="btn grow ratingnew">
                                                <i class="fas fa-star fa-lg mr-1 text-dark"></i>
                                                @foreach($ratingProduk as $starProduk)
                                                    @if($starProduk->id_produk == $data->id_produk)
                                                    <?php $totaleditrating++ ?>
                                                        {{round(($starProduk->hasil+3)/($starProduk->total+1), 2)}}
                                                    @endif
                                                @endforeach
                                                @if($totaleditrating == 0)
                                                    3
                                                @endif
                                            </a>
                                            @endif
                                        @endforeach
                                        @if($checkeditrating == 0)
                                            <a data-toggle="modal"
                                                data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                                data-idproduk="{{$data->id_produk}}" 
                                                data-namaproduk="{{$data->nama_produk}}" 
                                                href="#ratingnew" 
                                                class="btn grow ratingnew">
                                                <i class="fas fa-star fa-lg mr-1 text-dark"></i>
                                                @foreach($ratingProduk as $starProduk)
                                                    @if($starProduk->id_produk == $data->id_produk)
                                                        <?php $checkeditrating++ ?>
                                                        {{round(($starProduk->hasil+3)/($starProduk->total+1), 2)}}
                                                    @endif
                                                @endforeach
                                                @if($checkeditrating == 0)
                                                3
                                                @endif
                                            </a>
                                        @endif
                                        <div class="modal fade" id="ratingnew" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title float-left mr-2">Berikan Rating Menu</h5><h5 class="card-title float-left mt-1 text-warning" name="nama_produk" id="nama_produk"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body d-flex justify-content-center">
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="1"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="2"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="3"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x text-warning"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="4"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x"></i></button>
                                                        </div>
                                                    </form>
                                                    <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                        <div class="no-gutters p-0 float-left" style="margin-left: -8px; margin-top: -8px">
                                                            @csrf
                                                            <input hidden type="number" name="id_rating" id="id_rating" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <input hidden type="number" name="nilai" id="nilai" value="5"/>
                                                            <button type="submit" class="btn grow"><i class="fas fa-star fa-4x"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                <!-- end login star -->
                            @else
                                <!-- star -->
                                @if($countrating == 0)
                                    <div class="col-4 col-xl-4 col-lg-2 col-md-4 col-sm-4 pl-xl-0 pl-lg-3 pl-md-5 d-flex justify-content-center" style="margin-top: -8px"">
                                        <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn grow ml-sm-3"><i class="fas fa-star text-dark fa-lg mr-sm-1"></i>3</button>
                                        </form>
                                    </div>
                                @else
                                    @foreach($ratingProduk as $starProduk)
                                        @if($starProduk->id_produk == $data->id_produk)
                                        <?php $checkrating++ ?>
                                            <div class="col-4 col-xl-4 col-lg-2 col-md-4 col-sm-4 pl-xl-0 pl-lg-3 pl-md-5 d-flex justify-content-center" style="margin-top: -8px"">
                                                <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <button type="submit" class="btn grow ml-sm-3"><i class="fas fa-star text-dark fa-lg mr-sm-1"></i>
                                                    @foreach($ratingProduk as $starProduk)
                                                        @if($starProduk->id_produk == $data->id_produk)
                                                            {{round(($starProduk->hasil+3)/($starProduk->total+1), 2)}}
                                                        @endif
                                                    @endforeach
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($checkrating == 0)
                                        <div class="col-4 col-xl-4 col-lg-2 col-md-4 col-sm-4 pl-xl-0 pl-lg-3 pl-md-5 d-flex justify-content-center" style="margin-top: -8px"">
                                            <form role="form" method="post" action="{{ route('submit.rating') }}" enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit" class="btn grow ml-sm-3"><i class="fas fa-star text-dark fa-lg mr-sm-1"></i>3</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                                
                            @endif
                            <p class="card-text float-left" style="clear: left;">{{$data->deskripsi_produk}}</p>
                        </div>
                    </div>
                    <hr style="width: 100%;">
                    <div class="row no-gutters">
                    <!-- Login review and like -->
                    @if( auth('pelanggan')->check() )
                        @if($countlike == 0)
                            <div class="no-gutters p-0 mb-3 col-6 float-left" style="clear: left">
                                <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input hidden type="number" class="form-control" name="id_pelanggan" value="{{ auth('pelanggan')->user()->id_pelanggan }}">
                                    <input hidden type="number" class="form-control" name="id_produk" value="{{ $data->id_produk }}">
                                    <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                                </form>
                            </div>
                        @else
                            @foreach($like as $suka)
                                @if($suka->id_pelanggan == auth('pelanggan')->user()->id_pelanggan && $suka->id_produk == $data->id_produk)
                                <?php $checklike++ ?>
                                    <div class="no-gutters p-0 mb-3 col-6 float-left" style="clear: left">
                                        <form role="form" method="post" action="{{ route('delete.like', $suka->id_like) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn grow">
                                                <i class="fas fa-heart fa-lg mr-1" style="color: red"></i>
                                                @foreach($likeProduk as $sukaProduk)
                                                    @if($sukaProduk->id_produk == $data->id_produk)
                                                        {{$sukaProduk->total}}
                                                    @endif
                                                @endforeach
                                            </button>
                                        </form>
                                    </div>
                                @endif            
                            @endforeach
                            @if($checklike == 0)
                                <div class="no-gutters p-0 mb-3 col-6 float-left" style="clear: left">
                                    <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input hidden type="number" class="form-control" name="id_pelanggan" value="{{ auth('pelanggan')->user()->id_pelanggan }}">
                                        <input hidden type="number" class="form-control" name="id_produk" value="{{ $data->id_produk }}">
                                        <button type="submit" class="btn grow">
                                            <i class="far fa-heart fa-lg mr-1"></i>
                                            @foreach($likeProduk as $sukaProduk)
                                                @if($sukaProduk->id_produk == $data->id_produk)
                                                    {{$sukaProduk->total}}
                                                @endif
                                            @endforeach
                                            @foreach($editLike as $ubahLike)
                                                @if($ubahLike->id_produk == $data->id_produk)
                                                    <input hidden type="number" class="form-control" name="id_like" value="{{ $ubahLike->id_like }}">
                                                @endif
                                            @endforeach
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif

                        @if($countreview == 0)
                            <div class="no-gutters p-0 mb-3 col-6 float-left">
                                <a data-toggle="modal" 
                                    data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                    data-idproduk="{{$data->id_produk}}" 
                                    data-namaproduk="{{$data->nama_produk}}" 
                                    href="#review" 
                                    class="btn grow review">
                                    <i class="far fa-comment fa-lg mr-1"></i>
                                </a>
                                <div class="modal fade" id="review" tabindex="-1" role="dialog">
                                    <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Review</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="card-title" name="nama_produk" id="nama_produk"></h5>
                                                <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                <textarea name="review" id="review" class="form-control border-primary" rows="5"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                <button type="submit" class="btn btn-primary">Kirim review</button>
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            @foreach($review as $ulasan)
                                @if($ulasan->id_pelanggan == auth('pelanggan')->user()->id_pelanggan && $ulasan->id_produk == $data->id_produk)
                                <?php $checkreview++ ?>
                                    <div class="no-gutters p-0 mb-3 col-6 float-left">
                                        <a data-toggle="modal" 
                                            data-idreview="{{$ulasan->id_review}}" 
                                            data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                            data-idproduk="{{$data->id_produk}}" 
                                            data-namaproduk="{{$data->nama_produk}}"
                                            data-review="{{$ulasan->review}}"
                                            href="#reviewedit" 
                                            class="btn grow reviewedit">
                                            <i class="fas fa-comment fa-lg mr-1"></i>
                                            @foreach($reviewProduk as $ulasanProduk)
                                                @if($ulasanProduk->id_produk == $data->id_produk)
                                                    {{$ulasanProduk->total}}
                                                @endif
                                            @endforeach
                                        </a>
                                        <div class="modal fade" id="reviewedit" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Review</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form role="form" method="post" action="{{route('update.review', $ulasan->id_review)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                        <div class="modal-body">
                                                            <h5 class="card-title" name="nama_produk_edit" id="nama_produk_edit"></h5>
                                                            <input hidden type="number" name="id_review_edit" id="id_review_edit" value=""/>
                                                            <input hidden type="number" name="id_pelanggan_edit" id="id_pelanggan_edit" value=""/>
                                                            <input hidden type="number" name="id_produk_edit" id="id_produk_edit" value=""/>
                                                            <textarea name="review_edit" id="review_edit" class="form-control border-primary" rows="5"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Edit review</button>
                                                    </form>
                                                        <form role="form" method="post" action="{{route('delete.review', $ulasan->id_review)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input hidden type="number" name="id_review_delete" id="id_review_delete" value=""/>
                                                            <button onclick="return confirm('Yakin ingin menghapus comment anda?')" type="submit" class="btn btn-danger">Hapus Review</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if($checkreview == 0)
                                <div class="no-gutters p-0 mb-3 col-6 float-left">
                                    @foreach($editReview as $editulasan)
                                        @if($editulasan->id_produk == $data->id_produk)
                                        <?php $checkeditreview++ ?>
                                        <a data-toggle="modal" 
                                            data-reviewid="{{ $editulasan->id_review }}" 
                                            data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                            data-idproduk="{{$data->id_produk}}" 
                                            data-namaproduk="{{$data->nama_produk}}" 
                                            href="#review" 
                                            class="btn grow review">
                                            <i class="far fa-comment fa-lg mr-1"></i>
                                            @foreach($reviewProduk as $ulasanProduk)
                                                @if($ulasanProduk->id_produk == $data->id_produk)
                                                    {{$ulasanProduk->total}}
                                                @endif
                                            @endforeach
                                        </a>
                                        @endif
                                    @endforeach
                                    @if($checkeditreview == 0)
                                        <a data-toggle="modal" 
                                            data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                            data-idproduk="{{$data->id_produk}}" 
                                            data-namaproduk="{{$data->nama_produk}}" 
                                            href="#review" 
                                            class="btn grow review">
                                            <i class="far fa-comment fa-lg mr-1"></i>
                                            @foreach($reviewProduk as $ulasanProduk)
                                                @if($ulasanProduk->id_produk == $data->id_produk)
                                                    {{$ulasanProduk->total}}
                                                @endif
                                            @endforeach
                                        </a>
                                    @endif
                                    <div class="modal fade" id="review" tabindex="-1" role="dialog">
                                        <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Review</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="card-title" name="nama_produk" id="nama_produk"></h5>
                                                    <input hidden type="number" name="id_review" id="id_review" value=""/>
                                                    <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                    <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                    <textarea name="review" id="review" class="form-control border-primary" rows="5"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Kirim review</button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif
                    <!-- End Login review and like -->
                    @else
                    <!-- review and like -->
                        @if($countlike == 0)
                            <div class="no-gutters p-0 mb-3 col-6 float-left" style="clear: left">
                                <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                                </form>
                            </div>
                        @else
                            @foreach($likeProduk as $sukaProduk)
                                @if($sukaProduk->id_produk == $data->id_produk)
                                <?php $checklike++ ?>
                                <div class="no-gutters p-0 mb-3 col-6 float-left" style="clear: left">
                                    <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i>{{$sukaProduk->total}}</button>
                                    </form>
                                </div>
                                @endif
                            @endforeach
                            @if($checklike == 0)
                                <div class="no-gutters p-0 mb-3 col-6 float-left" style="clear: left">
                                    <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                                    </form>
                                </div>
                            @endif
                        @endif

                        @if($countreview == 0)
                            <div class="no-gutters p-0 mb-3 col-6 float-left">
                                <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn grow"><i class="far fa-comment fa-lg mr-1"></i></button>
                                </form>
                            </div>
                        @else
                            @foreach($reviewProduk as $ulasanProduk)
                                @if($ulasanProduk->id_produk == $data->id_produk)
                                <?php $checkreview++ ?>
                                <div class="no-gutters p-0 mb-3 col-6 float-left">
                                    <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn grow"><i class="far fa-comment fa-lg mr-1"></i>{{$ulasanProduk->total}}</button>
                                    </form>
                                </div>
                                @endif
                            @endforeach
                            @if($checkreview == 0)
                                <div class="no-gutters p-0 mb-3 col-6 float-left">
                                    <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn grow"><i class="far fa-comment fa-lg mr-1"></i></button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    <!-- end review and like -->
                    @endif
                    </div>
                    <img src="{{ asset('/imageforuser/menu/'. $data->gambar_produk) }}" alt="" width="100%"></td>
                    <div class="card-footer">
                        @if($data->nama_kategori == 'Makanan' || $data->nama_kategori == 'Minuman')
                            <a href="{{ route('detailproduk', $data->id_produk)}}" class="btn btn-info float-right animateBtn"><span>Detail <i class="fa fa-info-circle"></i></span></a>
                            <a href="{{route('menu')}}" class="btn btn-warning float-right mr-1 animateBtn">See Product <i class="fa fa-utensils"></i></a>
                        @else
                    <a href="{{ route('detailproduk', $data->id_produk)}}" class="btn btn-info float-right animateBtn"><span>Detail <i class="fa fa-info-circle"></i></span></a>
                            <a href="{{route('shop')}}" class="btn btn-warning float-right mr-1 animateBtn">See Product <i class="fa fa-utensils"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 p-2">
        <div class="col-12 p-3">
            <div class="card border-success" style="width: 100%;">
                <div class="card-header bg-success">
                    <h5 class="card-title text-white">Kategori</h5>
                </div>
            @foreach($kategori as $result)
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$result->nama_kategori}} <span class="badge badge-success float-right">{{$result->nama_produk}}</span></li>
                </ul>
            @endforeach
            </div>
        </div>
        @if($data->nama_kategori == 'Makanan')
            <div class="col-12 p-3">
                <div class="card border-warning" style="width: 100%;">
                    <div class="card-header bg-warning">
                        <h5 class="card-title">Suggestion Menu</h5>
                    </div>
                @foreach($minuman as $result)
                    <ul class="list-group list-group-flush">
                        <a class="text-decoration-none" href="{{ route('detailproduk', $result->id_produk)}}"><li class="list-group-item">{{$result->nama_produk}}</li></a>
                    </ul>
                @endforeach
                </div>
            </div>
        @elseif($data->nama_kategori == 'Minuman')
            <div class="col-12 p-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header bg-warning">
                        <h5 class="card-title">Suggestion Menu</h5>
                    </div>
                @foreach($makanan as $result)
                    <ul class="list-group list-group-flush">
                        <a class="text-decoration-none" href="{{ route('detailproduk', $result->id_produk)}}"><li class="list-group-item">{{$result->nama_produk}}</li></a>
                    </ul>
                @endforeach
                </div>
            </div>
        @elseif($data->nama_kategori == 'Alat Dapur')
            <div class="col-12 p-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header bg-warning">
                        <h5 class="card-title">Suggestion Cooking Tools</h5>
                    </div>
                @foreach($alat as $result)
                    <ul class="list-group list-group-flush">
                        <a class="text-decoration-none" href="{{ route('detailproduk', $result->id_produk)}}"><li class="list-group-item">{{$result->nama_produk}}</li></a>
                    </ul>
                @endforeach
                </div>
            </div>
        @else
            <div class="col-12 p-3">
                <div class="card" style="width: 100%;">
                    <div class="card-header bg-warning">
                        <h5 class="card-title">Suggestion Product</h5>
                    </div>
                @foreach($shop as $result)
                    <ul class="list-group list-group-flush">
                        <a class="text-decoration-none" href="{{ route('detailproduk', $result->id_produk)}}"><li class="list-group-item">{{$result->nama_produk}}</li></a>
                    </ul>
                @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="col-12 d-flex justify-content-center">
        <span>{{$hasil->links()}}</span>
    </div>
</div>
@endsection