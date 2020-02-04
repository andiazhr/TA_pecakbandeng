@extends('itsfood.index')
@section('content')
<div class="col-12 d-flex justify-content-center pt-3 text-secondary">
    <div class="row no-gutters">
        <div class="col-12 d-flex justify-content-center">
            <h3 style="font-family: raleway">All Pecak Bandeng Menu&#8242;s</h3>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <p style="font-size: 17px">
                <a href="/itsfood" class="text-decoration-none text-warning">ItsFood</a>
                &#155; 
                <a href="menu" class="text-decoration-none text-warning">Menu</a>
            </p>
        </div>
    </div>
</div>
<div class="row no-gutters p-3" style="margin-top: -40px">
    @foreach($data as $menu)
        <?php $check = 0 ?>
        <?php $checklike = 0 ?>
        <?php $checkreview = 0 ?>
    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 pr-3 pl-3 mt-4">
        <div class="card border-warning" style="width: 100%;">
            <img src="{{ asset('/imageforuser/menu/'. $menu->gambar_produk) }}" class="card-img-top d-none d-sm-none d-md-none d-lg-none d-lg-block d-xl-none d-xl-block image image-xlf image-lgf" alt="...">
            <img src="{{ asset('/imageforuser/menu/'. $menu->gambar_produk) }}" class="d-none d-sm-none d-md-none d-md-block d-lg-none d-xl-none" height="300px" alt="...">
            <img src="{{ asset('/imageforuser/menu/'. $menu->gambar_produk) }}" class="card-img-top d-sm-none d-sm-block d-md-none d-lg-none d-xl-none image-smf" alt="...">
            <div class="card-body">
                <h5 class="card-title" style="font-size: 18px; white-space: nowrap; width: 235px; overflow: hidden; text-overflow: ellipsis;">{{$menu->nama_produk}}</h5>
                @foreach($menu->ProdukKegiatan as $produkevent)
                    @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                        @if($menu->id_produk == $produkevent->id_produk)
                            <?php $check++ ?>
                            <h6 class="card-title bg-warning pt-1 pb-1 pl-2 pr-2 text-danger rounded float-left mr-3" style="font-size: 15px;">Harga Event <p class="bg-danger rounded text-white mt-1 p-2" style="font-size: 14px;">{{ number_format($menu->harga_produk - ($menu->harga_produk*$produkevent->discount/100))}} IDR</p></h6>
                            <h6 class="card-title bg-warning pt-1 pb-1 pl-2 pr-2 float-left text-danger rounded" style="font-size: 15px;"> Harga Normal <p class="bg-danger rounded text-white mt-1 p-2" style="font-size: 14px; text-decoration: line-through">{{ number_format($menu->harga_produk)}} IDR</p></h6>
                        @else
                            <!-- <h6 class="card-title bg-warning pt-1 pb-1 pl-2 pr-2 float-left text-danger rounded" style="font-size: 15px;"> Harga Normal <p class="bg-danger rounded text-white mt-1 p-2" style="font-size: 14px;">{{ number_format($menu->harga_produk)}} IDR</p></h6> -->
                        @endif
                    @endif
                @endforeach
                @if($check == 0)
                    <h6 class="card-title bg-warning pt-1 pb-1 pl-2 pr-2 float-left text-danger rounded" style="font-size: 15px;"> Harga Normal <p class="bg-danger rounded text-white mt-1 p-2" style="font-size: 14px;">{{ number_format($menu->harga_produk)}} IDR</p></h6>
                @endif

                <!-- Login review and like -->
                @if( auth('pelanggan')->check() )
                    @if($countlike == 0)
                        <form role="form" method="post" action="{{ route('submit.like') }}" enctype="multipart/form-data">
                            <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                @csrf
                                <input hidden type="number" class="form-control" name="id_pelanggan" value="{{ auth('pelanggan')->user()->id_pelanggan }}">
                                <input hidden type="number" class="form-control" name="id_produk" value="{{ $menu->id_produk }}">
                                <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                            </div>
                        </form>
                    @else
                        @foreach($like as $suka)
                            @if($suka->id_pelanggan == auth('pelanggan')->user()->id_pelanggan && $suka->id_produk == $menu->id_produk)
                            <?php $checklike++ ?>
                                <form role="form" method="post" action="{{ route('delete.like', $suka->id_like) }}" enctype="multipart/form-data">
                                    <div class="no-gutters p-0 mb-1 col-6 float-left" style="clear: left">
                                        @csrf
                                        <button class="btn grow">
                                            <i class="fas fa-heart fa-lg mr-1" style="color: red"></i>
                                            @foreach($likeProduk as $sukaProduk)
                                                @if($sukaProduk->id_produk == $menu->id_produk)
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
                                    <input hidden type="number" class="form-control" name="id_produk" value="{{ $menu->id_produk }}">
                                    <button type="submit" class="btn grow">
                                        <i class="far fa-heart fa-lg mr-1"></i>
                                        @foreach($likeProduk as $sukaProduk)
                                            @if($sukaProduk->id_produk == $menu->id_produk)
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
                                data-idproduk="{{$menu->id_produk}}" 
                                data-namaproduk="{{$menu->nama_produk}}" 
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
                            @if($ulasan->id_pelanggan == auth('pelanggan')->user()->id_pelanggan && $ulasan->id_produk == $menu->id_produk)
                            <?php $checkreview++ ?>
                                <div class="no-gutters p-0 mb-1 col-6 float-left">
                                    <a data-toggle="modal" 
                                        data-idreview="{{$ulasan->id_review}}" 
                                        data-id="{{ auth('pelanggan')->user()->id_pelanggan }}" 
                                        data-idproduk="{{$menu->id_produk}}" 
                                        data-namaproduk="{{$menu->nama_produk}}"
                                        data-review="{{$ulasan->review}}"
                                        href="#reviewedit" 
                                        class="btn grow reviewedit">
                                        <i class="fas fa-comment fa-lg mr-1"></i>
                                        @foreach($reviewProduk as $ulasanProduk)
                                            @if($ulasanProduk->id_produk == $menu->id_produk)
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
                                    data-idproduk="{{$menu->id_produk}}" 
                                    data-namaproduk="{{$menu->nama_produk}}" 
                                    href="#review" 
                                    class="btn grow review">
                                    <i class="far fa-comment fa-lg mr-1"></i>
                                    @foreach($reviewProduk as $ulasanProduk)
                                        @if($ulasanProduk->id_produk == $menu->id_produk)
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
                                <input hidden type="number" class="form-control" name="id_produk" value="{{ $menu->id_produk }}">
                                <button type="submit" class="btn grow"><i class="far fa-heart fa-lg mr-1"></i></button>
                            </div>
                        </form>
                    @else
                        @foreach($likeProduk as $sukaProduk)
                            @if($sukaProduk->id_produk == $menu->id_produk)
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
                            @if($ulasanProduk->id_produk == $menu->id_produk)
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
                <a href="{{ route('detailproduk', $menu->id_produk)}}" style="clear: left" class="btn btn-info float-right animateBtn"><span>Detail <i class="fa fa-info-circle"></i></span></a>
                <a href="{{ route('addkeranjang', ['id_produk' => $menu->id_produk])}}" class="btn btn-warning float-right mr-1 animateBtn">Add To Cart <i class="fa fa-utensils"></i></a>
            </div>
        </div>
    </div>
    @endforeach
    
    <div class="col-12 d-flex justify-content-center mt-3">
        <span>{{$data->links()}}</span>
    </div>
</div>
@endsection