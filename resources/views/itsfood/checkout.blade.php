@extends('itsfood.index')
@section('content')
<div class="col-12 d-flex justify-content-center pt-3 text-secondary">
    <h3 style="font-family: raleway">Checkout</h3>
</div>
    <!-- @foreach($produks as $produk)
    @endforeach
    @if(($produk['produk']['id_kategori'] != 3 || $produk['produk']['id_kategori'] == 2))
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-danger">
                    Your purchase has not been verified <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @elseif(($produk['produk']['id_kategori'] == 3 || $produk['produk']['id_kategori'] != 2))
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-danger">
                    Your purchase has not been verified <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @else
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-success">
                    Your purchase is verified <img src="{{ asset ('/imageforuser/checked5.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @endif
     -->
    @if(session()->get('error'))
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-danger">
                    {{ session()->get('error') }} <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @endif

    @if(session()->get('fail'))
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px;">
                <div class="alert alert-danger">
                    {{ session()->get('fail') }} <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @endif
    
    @if($errors->any())
        <div class="col-12 d-flex justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-5" style="text-align:center; font-size:16px;">
                <div class="alert alert-warning">
                    Anda Belum Memilih Booking atau Diambil <img src="{{ asset ('/imageforuser/warning.png') }}" alt="Jet" style="width:30px;height:30px;">
                </div>
            </div>
        </div>
    @endif
    
<div class="row no-gutters d-flex justify-content-center">

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-3">
        <form action="{{ route('checkout.submit') }}" method="post" id="form-pesan">
        @csrf
            <div class="card border-success" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">Detail Pembelian</h5>
                    <hr class="bg-success" style="width: 100%;">
                    <h6 class="card-title">{{ auth('pelanggan')->user()->nama_pelanggan }}</h6>
                    <p class="card-title" style="font-size:14px;">{{ auth('pelanggan')->user()->phone_number }}</p>

                    <div class="col-12 p-0">
                        <input type="radio" id="jasa2" onchange="myJasa2()" name="status" value="1|0"> Booking &nbsp; 
                        <input type="radio" id="jasa3" onchange="myJasa3()" name="status" value="2|0"> Diambil
                        <input type="radio" hidden id="decoy" onchange="myDecoy()" name="status" value="Decoy|0">
                    </div>
                    
                    <input type="text" disabled class="form-control mt-3" name="catatan" id="catatan" placeholder="Ex: untuk 2 orang/diambil sendiri">
                    
                    <hr class="bg-success" style="width: 100%;">
                    @if(Session::has('keranjang'))
                    <?php $sum_keranjang = 0 ?>
                    <?php $jumbel = 0 ?>
                        @foreach($produks as $produk)
                            <?php $check = 0 ?>
                            <img src="{{ asset('/imageforuser/menu/'. $produk['produk']['gambar_produk']) }}" style="width:70px; height: 40px;">
                            {{ $produk['produk']['nama_produk']}}
                            <input type="number" hidden name="id_produk[]" value="{{ $produk['produk']['id_produk']}}">
                            @foreach($produkkegiatan as $produkevent)
                                @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                                    @if($produk['produk']['id_produk'] == $produkevent->id_produk)
                                        <?php $check++ ?>
                                        <input hidden type="number" name="harga_produk[]" value="{{$produk['jumbel']*($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100))}}">
                                        <?php $sum_keranjang += ($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100)) * $produk['jumbel']?>
                                        <?php $jumbel += $produk['jumbel']?>
                                    @endif
                                @endif
                            @endforeach
                            @if($check == 0)
                                <input hidden type="number" name="harga_produk[]" value="{{$produk['jumbel']*($produk['produk']['harga_produk'])}}">
                                <?php $sum_keranjang += $produk['produk']['harga_produk'] * $produk['jumbel'] ?>
                                <?php $jumbel += $produk['jumbel']?>
                            @endif
                            <input type="number" hidden name="jumbel_produk[]" value="{{$produk['jumbel']}}">
                            <input type="number" hidden name="id_stok[{{$loop->index}}][id]" value="{{ $produk['produk']['id_stok']}}">
                            <input type="number" hidden name="id_stok[{{$loop->index}}][stok]" value="{{ $produk['produk']['stok']['stok']}}">
                            <input type="number" hidden name="id_stok[{{$loop->index}}][jumbel]" value="{{ $produk['jumbel']}}">
                            <br><br>
                        @endforeach
                    @else
                    <h5 class="card-title d-flex justify-content-center p-3">No product in cart</h5>
                    <a href="{{route('menu')}}" class="btn btn-warning float-right mr-1 animateBtn">See Product <i class="fa fa-utensils"></i></a>
                    @endif         
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-5 p-3">
            <div class="card border-success" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">Ringkasan Belanja</h5>
                    <hr class="bg-success" style="width: 100%;">
                    <div class="col-12 p-0" style="font-size: 18px ">
                        Total Harga ({{ Session::has('keranjang') ? Session::get('keranjang')->totalJumbel : ''}} Menu)
                        <input hidden type="text" id="totalpembelian" value="{{$sum_keranjang}}">
                        <!-- <input hidden type="text" id="totalpembelian" name="min_jumbel" value="{{$jumbel}}"> -->
                        <h5 class="card-title float-right" style="color: #28a745;">{{ number_format($sum_keranjang)}} IDR</h5><br><br>
                        <h5 class="card-title float-left">Total Ongkir</h5>
                        <input hidden type="text" name="ongkir" id="totalongkir">
                        <h5 class="card-title float-right pl-1" style="color: #28a745;">IDR</h5>
                        <h5 class="card-title float-right" style="color: #28a745;" id="totalOngkir"></h5>
                    </div>
                    <hr class="bg-success float-right" style="width: 100%;">
                    <div class="col-12 p-0" style="font-size: 18px; font-weight: bold">
                        <h5 class="card-title float-left">Total Tagihan</h5>
                        <input hidden type="text" name="total_pembelian" id="totaltagihan">
                        <h5 class="card-title float-right pl-1" style="color: #28a745;">IDR</h5>
                        <h5 class="card-title float-right" style="color: #28a745;" id="totalTagihan"></h5>
                    </div>
                    <hr class="bg-success float-right" style="width: 100%;">
                    <div class="col-12 float-right p-0 mt-3">
                    <button type="button" class="btn btn-warning float-right mr-1 animateBtn" data-toggle="modal" data-target="#invoice">Pesan Sekarang <i class="fab fa-telegram-plane"></i></a></button>
                        <div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="invoice" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center text-warning">Apakah yakin pesanan produk anda sudah benar?</h5>
                                        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row no-gutters">
                                            <div class="col-4"><h5 class="card-title">Nama Produk</h5></div>
                                            <div class="col-4 text-center"><h5 class="card-title">Jumlah Beli</h5></div>
                                            <div class="col-4 text-right"><h5 class="card-title">Harga Produk</h5></div>
                                        @foreach($produks as $produk)
                                            <?php $checkinvoice = 0 ?>
                                            <div class="col-4">
                                                <h6 class="card-title float-left">
                                                {{ $produk['produk']['nama_produk']}}
                                                </h6>
                                            </div>
                                            <div class="col-4 text-center">
                                                <h6 class="card-title" style="color: #28a745;">
                                                    {{$produk['jumbel']}}
                                                </h6>
                                            </div>
                                            <div class="col-4 text-right">
                                                <h6 class="card-title" style="color: #28a745;">
                                                    @foreach($produkkegiatan as $produkevent)
                                                        @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                                                            @if($produk['produk']['id_produk'] == $produkevent->id_produk)
                                                                <?php $checkinvoice++ ?>
                                                                {{number_format($produk['jumbel']*($produk['produk']['harga_produk']-($produk['produk']['harga_produk']*$produkevent->discount/100)))}} IDR
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if($checkinvoice == 0)
                                                        {{number_format($produk['jumbel']*($produk['produk']['harga_produk']))}} IDR
                                                    @endif
                                                </h6>
                                            </div>
                                        @endforeach
                                            <hr style="width: 100%;">
                                            <div class="col-6"><h6 class="card-title">Total Tagihan</h6></div>
                                            <div class="col-6"><h6 class="card-title text-right"  style="color: #28a745;">{{ number_format($sum_keranjang)}} IDR</h6></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary float-right mr-1 animateBtn" data-toggle="modal" data-target="#exampleModal">Pesan Sekarang <i class="fab fa-telegram-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection