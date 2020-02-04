@extends('itsfood.index')
@section('content')
<div class="col-12 d-flex justify-content-center pt-3 text-secondary">
    <h3 style="font-family: raleway">Keranjang</h3>
</div>
<div class="row no-gutters d-flex justify-content-center">
    <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7 p-3">
        <div class="card border-success" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-center">Detail Pembelian</h5>
                <hr class="bg-success" style="width: 100%;">
                @if(Session::has('keranjang'))
                <!-- <ol class="card-title"> -->
                <?php $sum_keranjang = 0 ?>
                    @foreach($produks as $produk)
                        <?php $check = 0 ?>
                        <div class="row no-gutters p-0">
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pl-xl-4 pt-xl-1 mb-xl-1 mb-md-3 mb-sm-3">
                                <div class="card border-success">
                                   <img src="{{ asset('/imageforuser/menu/'. $produk['produk']['gambar_produk']) }}" style="width:100%;">
                                </div>
                            </div>

                            <div class="col-xl-5 col-lg-6 col-md-9 col-sm-6 p-xl-4 pl-lg-3 py-lg-3 px-md-4 py-md-2 p-sm-3 mb-xl-1 mb-sm-3 mt-2 d-block d-sm-none d-md-none d-lg-none d-xl-none">
                                <div class="row no-gutters p-0">
                                    <div class="col-12">
                                        <a class="float-right ml-1 mr-1" href="{{ route('tambahSatu', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus fa-xs"></i></button></a>
                                        @if( $produk['jumbel'] == 1)
                                        <a class="float-right ml-1"><button disabled type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus fa-xs"></i></button></a>
                                        @else
                                        <a class="float-right ml-1" href="{{ route('kurangiSatu', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus fa-xs"></i></button></a>
                                        @endif
                                        <a class="float-right ml-3" href="{{ route('hapusSemua', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-xs"></i></button></a>
                                        
                                        @foreach($produkkegiatan as $produkevent)
                                            @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                                                @if($produk['produk']['id_produk'] == $produkevent->id_produk)
                                                    <?php $check++ ?>
                                                    <p class="float-right mt-1 ml-3" style="color: #28a745">{{ number_format($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100))}} IDR</p>
                                                    <input hidden type="number" id="priceevent" value="{{$produk['jumbel']*($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100))}}">
                                                @endif
                                            @endif
                                        @endforeach
                            
                                        @if($check == 0)
                                            <p class="float-right mt-1 ml-3" style="color: #28a745">{{ number_format($produk['produk']['harga_produk'])}} IDR</p>
                                            <input hidden type="number" id="price" value="{{$produk['jumbel']*$produk['produk']['harga_produk']}}">
                                        @endif

                                        <span class="badge badge-info float-right mt-2">{{ $produk['jumbel']}}</span>
                                        
                                        <p class="float-right mt-1" style="white-space: nowrap; width: 175px; overflow: hidden; text-overflow: ellipsis;">{{ $produk['produk']['nama_produk']}} </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-5 col-lg-6 col-md-9 col-sm-6 p-xl-4 pl-lg-3 py-lg-3 px-md-4 py-md-2 p-sm-3 mb-xl-1 mb-sm-3 d-none d-sm-block d-md-block d-lg-block d-xl-block">
                                <div class="row no-gutters p-0">
                                    <div class="col-12">
                                            <p class="float-left" style="white-space: nowrap; width: 175px; overflow: hidden; text-overflow: ellipsis;">{{ $produk['produk']['nama_produk']}} </p><span class="badge badge-info float-left mt-1">{{ $produk['jumbel']}}</span>
                                    </div>
                                    <div class="col-12" style="margin-top: -15px;">
                                        @foreach($produkkegiatan as $produkevent)
                                            @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                                                @if($produk['produk']['id_produk'] == $produkevent->id_produk)
                                                    <?php $check++ ?>
                                                    <p style="color: #28a745">{{ number_format($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100))}} IDR</p>
                                                    <input hidden type="number" id="priceevent" value="{{$produk['jumbel']*($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100))}}">
                                                    <?php $sum_keranjang += ($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100)) * $produk['jumbel']?>
                                                @endif
                                            @endif
                                        @endforeach
                            
                                        @if($check == 0)
                                            <p style="color: #28a745">{{ number_format($produk['produk']['harga_produk'])}} IDR</p>
                                            <input hidden type="number" id="price" value="{{$produk['jumbel']*$produk['produk']['harga_produk']}}">
                                            <?php $sum_keranjang += $produk['produk']['harga_produk'] * $produk['jumbel'] ?>
                                        @endif
                                    </div>
                                    <div class="col-12 d-none d-sm-none d-md-block d-lg-none d-xl-none" style="margin-top: -10px;">
                                        <a class="float-left ml-5" href="{{ route('hapusSemua', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-xs"></i></button></a>
                                        @if( $produk['jumbel'] == 1)
                                        <a class="float-left ml-1"><button disabled type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus fa-xs"></i></button></a>
                                        @else
                                        <a class="float-left ml-1" href="{{ route('kurangiSatu', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus fa-xs"></i></button></a>
                                        @endif
                                        <a class="float-left ml-1" href="{{ route('tambahSatu', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus fa-xs"></i></button></a>
                                    </div>
                                </div>
                            </div>
                            <hr class="d-none d-block d-sm-none d-md-block d-lg-none d-xl-none bg-success" style="width: 100%;">

                            <div class="col-xl-4 col-lg-3 col-md-6 col-sm-3 p-xl-4 py-lg-4 py-sm-4 d-none d-sm-none d-sm-block d-md-none d-lg-block d-xl-block">
                                <a class="float-right ml-1" href="{{ route('tambahSatu', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button></a>
                                @if( $produk['jumbel'] == 1)
                                <a class="float-right ml-1"><button disabled type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus"></i></button></a>
                                @else
                                <a class="float-right ml-1" href="{{ route('kurangiSatu', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-warning"><i class="fa fa-minus"></i></button></a>
                                @endif
                                <a class="float-right ml-5" href="{{ route('hapusSemua', ['id_produk' => $produk['produk']['id_produk']]) }}"><button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></a>
                            </div>
                        </div>
                        <!-- <li class="mb-4"></li> -->
                            <!-- <div class="btn-group float-right" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="{{ route('kurangiSatu', ['id_produk' => $produk['produk']['id_produk']]) }}">Kurangi 1</a>
                                <a class="dropdown-item" href="{{ route('hapusSemua', ['id_produk' => $produk['produk']['id_produk']]) }}">Hapus Semua</a>
                                </div>
                            </div> -->
                    @endforeach
                <!-- </ol> -->
                @else
                <h5 class="card-title d-flex justify-content-center p-3">No product in cart</h5>
                <a href="{{route('menu')}}" class="btn btn-warning float-right mr-1 animateBtn">See Product <i class="fa fa-utensils"></i></a>
                @endif         
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-5 col-lg-4 col-xl-4 p-3">
        <div class="card border-success" style="width: 100%;">
        @if(Session::has('keranjang'))
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-center">Ringkasan Belanja</h5>
                <hr class="bg-success" style="width: 100%;">
                <!-- @foreach($produks as $produk)
                <div class="col-12 p-0" style="font-size: 18px ">
                    {{ $produk['produk']['nama_produk']}}
                    <h5 class="card-title float-right" style="color: #28a745;">{{ $produk['jumbel']}} x {{ $produk['produk']['harga_produk']}}</h5><br><br>
                </div>
                @endforeach
                <hr class="bg-success" style="width: 100%;"> -->
                <div class="col-12 p-0">
                    <h5 class="float-left">Total Harga : </h5>
                    <h5 class="card-title float-right" style="color: #28a745">{{ number_format($sum_keranjang)}} IDR</h5>
                    <!-- <input type="number" name="id_produk[]" value="{{$sum_keranjang}}"> -->
                </div>
                <div class="col-12 float-right p-0 mt-3">
                    <a href="{{route('checkout')}}" class="btn btn-info float-right mr-1 animateBtn">Checkout <i class="fab fa-telegram-plane"></i></a>
                </div>
            </div>
            @else
            <h5 class="card-title d-flex justify-content-center p-3">No product in cart</h5>
            @endif
        </div>
    </div>
</div>
@endsection