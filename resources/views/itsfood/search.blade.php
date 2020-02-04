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
            <?php $checklike = 0 ?>
            <?php $checkreview = 0 ?>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 p-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title float-left">{{$data->nama_produk}}</h5>
                        @if($data->nama_kategori == 'Makanan')
                        <h6 class="card-title float-right"><span class="badge badge-danger">{{$data->nama_kategori}}</span></h6>
                        @elseif($data->nama_kategori == 'Minuman')
                        <h6 class="card-title float-right"><span class="badge badge-primary">{{$data->nama_kategori}}</span></h6>
                        @else
                        <h6 class="card-title float-right"><span class="badge badge-secondary">{{$data->nama_kategori}}</span></h6>
                        @endif
                        <p class="card-text float-left" style="clear: left;">{{$data->deskripsi_produk}}</p>
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
                                                        <div class="modal-body">
                                                            <h5 class="card-title" name="nama_produk" id="nama_produk"></h5>
                                                            <input hidden type="number" name="id_review" id="id_review" value=""/>
                                                            <input hidden type="number" name="id_pelanggan" id="id_pelanggan" value=""/>
                                                            <input hidden type="number" name="id_produk" id="id_produk" value=""/>
                                                            <textarea name="review" id="review" class="form-control border-primary" rows="5"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                                            <button type="submit" class="btn btn-primary">Edit review</button>
                                                    </form>
                                                        <form role="form" method="post" action="{{route('delete.review', $ulasan->id_review)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input hidden type="number" name="id_review_delete" id="id_review_delete" value=""/>
                                                            <button type="submit" class="btn btn-danger">Hapus Review</button>
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
                                    <a data-toggle="modal"
                                        data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                        data-idproduk="{{$data->id_produk}}" 
                                        data-namaproduk="{{$data->nama_produk}}" 
                                        href="#reviewsearch" 
                                        class="btn grow reviewsearch">
                                        <i class="far fa-comment fa-lg mr-1"></i>
                                        @foreach($reviewProduk as $ulasanProduk)
                                            @if($ulasanProduk->id_produk == $data->id_produk)
                                                {{$ulasanProduk->total}}
                                            @endif
                                        @endforeach
                                    </a>
                                    <div class="modal fade" id="reviewsearch" tabindex="-1" role="dialog">
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
                            @endif
                        @endif
                    <!-- End Login review and like -->
                    @else
                    <!-- review and like -->
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
            <div class="card" style="width: 100%;">
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
                <div class="card" style="width: 100%;">
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
</div>
@endsection