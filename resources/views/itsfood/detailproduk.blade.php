@extends('itsfood.index')
@section('content')
<div class="col-12 d-flex justify-content-center pt-3">
    <h3 style="font-family: raleway">Detail Menu</h3>
</div>
<div class="row no-gutters p-3 d-flex justify-content-center">

    <?php $check = 0 ?>
    <?php $checklike = 0 ?>
    <?php $checkreview = 0 ?>
    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-3">
        <div class="card" style="width: 100%;">
            <img src="{{ asset('/imageforuser/menu/'. $data->gambar_produk) }}" class="card-img-top grow" alt="...">
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-3">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">{{$data->nama_produk}}</h5>
                @foreach($data->ProdukKegiatan as $produkevent)
                    @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                        @if($data->id_produk == $produkevent->id_produk)
                            <?php $check++ ?>
                            <h3 class="card-title" style="color: orange">@foreach($data->ProdukKegiatan as $produkevent){{ number_format($data->harga_produk - ($data->harga_produk*$produkevent->discount/100))}} IDR @endforeach</h3>
                            <h3 class="card-title" style="color: orange; text-decoration: line-through">{{ number_format($data->harga_produk)}} IDR</h3>
                        @endif
                    @endif
                @endforeach
                @if($check == 0)
                    <h3 class="card-title" style="color: orange">{{ number_format($data->harga_produk)}} IDR</h3>
                @endif
                <p class="card-text" style="font-family: raleway; font-size: 15px;">
                <?php
                    if($data->KategoriProduk->nama_kategori == 'Makanan'){
                        echo 'Kategori : '. '<span class="badge badge-danger">'.$data->KategoriProduk->nama_kategori.'</span>';
                    }elseif($data->KategoriProduk->nama_kategori == 'Minuman'){
                        echo 'Kategori : '. '<span class="badge badge-primary">'.$data->KategoriProduk->nama_kategori.'</span>';
                    }elseif($data->KategoriProduk->nama_kategori != 'Makanan' || $data->KategoriProduk->nama_kategori != 'Minuman'){
                        echo 'Kategori : '. '<span class="badge badge-secondary">'.$data->KategoriProduk->nama_kategori.'</span>';
                    }
                ?>
                </p>
                <hr style="width: 100%;">
                <p class="card-text">{{$data->deskripsi_produk}}</p>
                <hr style="width: 100%;">
                <!-- Login review and like -->
                @if( auth('pelanggan')->check() )
                    @if($countlike == 0)
                        <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                            <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                @csrf
                                <input hidden type="number" class="form-control" name="id_pelanggan" value="{{ auth('pelanggan')->user()->id_pelanggan }}">
                                <input hidden type="number" class="form-control" name="id_produk" value="{{ $data->id_produk }}">
                                <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                            </div>
                        </form>
                    @else
                        @foreach($like as $suka)
                            @if($suka->id_pelanggan == auth('pelanggan')->user()->id_pelanggan && $suka->id_produk == $data->id_produk)
                            <?php $checklike++ ?>
                                <form role="form" method="post" action="{{ route('delete.like', $suka->id_like) }}" enctype="multipart/form-data">
                                    <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                        @csrf
                                        <button class="btn grow">
                                            <i class="fas fa-heart fa-lg mr-1" style="color: red"></i>
                                            @foreach($likeProduk as $sukaProduk)
                                                @if($sukaProduk->id_produk == $data->id_produk)
                                                    {{$sukaProduk->total}}
                                                @endif
                                            @endforeach
                                        </button>
                                    </div>
                                </form>
                            @endif            
                        @endforeach
                        @if($checklike == 0)
                            <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
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
                                </div>
                            </form>
                        @endif
                    @endif

                    @if($countreview == 0)
                        <div class="no-gutters p-0 mb-1 col-6 float-left">
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
                                <div class="no-gutters p-0 mb-1 col-6 float-left">
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
                            <div class="no-gutters p-0 mb-1 col-6 float-left">
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
                        @endif
                    @endif
                <!-- End Login review and like -->
                @else
                <!-- review and like -->
                    @if($countlike == 0)
                        <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                            <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                @csrf
                                <input hidden type="number" class="form-control" name="id_pelanggan" value="{{ auth('pelanggan')->user()->id_pelanggan }}">
                                <input hidden type="number" class="form-control" name="id_produk" value="{{ $data->id_produk }}">
                                <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                            </div>
                        </form>
                    @else
                        @foreach($likeProduk as $sukaProduk)
                            @if($sukaProduk->id_produk == $data->id_produk)
                            <?php $checklike++ ?>
                            <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                    @csrf
                                    <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i>{{$sukaProduk->total}}</button>
                                </div>
                            </form>
                            @endif
                        @endforeach
                        @if($checklike == 0)
                            <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                                <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                    @csrf
                                    <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                                </div>
                            </form>
                        @endif
                    @endif

                    @if($countreview == 0)
                        <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                            <div class="no-gutters p-0 mb-1 col-6 float-left">
                                @csrf
                                <button type="submit" class="btn grow"><i class="far fa-comment fa-lg mr-1"></i></button>
                            </div>
                        </form>
                    @else
                        @foreach($reviewProduk as $ulasanProduk)
                            @if($ulasanProduk->id_produk == $data->id_produk)
                            <?php $checkreview++ ?>
                            <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                <div class="no-gutters p-0 mb-1 col-6 float-left">
                                    @csrf
                                    <button type="submit" class="btn grow"><i class="far fa-comment fa-lg mr-1"></i>{{$ulasanProduk->total}}</button>
                                </div>
                            </form>
                            @endif
                        @endforeach
                        @if($checkreview == 0)
                            <form role="form" method="post" action="{{ route('submit.review') }}" enctype="multipart/form-data">
                                <div class="no-gutters p-0 mb-1 col-6 float-left">
                                    @csrf
                                    <button type="submit" class="btn grow"><i class="far fa-comment fa-lg mr-1"></i></button>
                                </div>
                            </form>
                        @endif
                    @endif
                <!-- end review and like -->
                @endif
                <a href="{{ route('addkeranjang', ['id_produk' => $data->id_produk])}}" class="btn btn-warning float-right mr-1 animateBtn">Add To Cart <i class="fa fa-utensils"></i></a>
            </div>
        </div>
    </div>
    
</div>
@endsection