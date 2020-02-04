@extends('itsfood.index')
@section('content')
<div class="bd-example">
@if(session()->get('login'))
  <div class="col-12 d-flex justify-content-center">
      <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px; position: absolute; top:120px; z-index: 1">
          <div class="alert alert-info">
              {{ session()->get('login') }} {{ auth('pelanggan')->user()->nama_pelanggan }} <img src="{{ asset ('/imageforuser/wavehand.png') }}" alt="Jet" style="width:30px;height:30px;">
          </div>
      </div>
  </div>
@endif

@if(session()->get('success'))
  <div class="col-12 d-flex justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4 col-xl-4" style="text-align:center; font-size:16px; position: absolute; top:120px; z-index: 1">
              <div class="alert alert-success">
        {{ auth('pelanggan')->user()->nama_pelanggan }}, {{ session()->get('success') }} <img src="{{ asset ('/imageforuser/checked5.png') }}" alt="Jet" style="width:30px;height:30px;">
              </div>
      </div>
  </div>
@endif
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li class="item1 active"></li>
      <li class="item2"></li>
      <li class="item3"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset ('imageforuser/menu2/friedrice1.jpg') }}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset ('imageforuser/menu2/friedrice2.jpg') }}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset ('imageforuser/menu2/friedrice3.jpg') }}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<div class="row no-gutters bg-light p-3 d-flex justify-content-center">
  <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 d-none d-lg-block d-xl-none d-xl-block">
    <div class="spinner"></div>
    <div class="sk-folding-cube d-none d-xl-block">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
  </div>
  <div class="col-sm-12 col-md-12 col-lg-7 col-xl-7 pt-1 c-video ">
    @foreach($produkkegiatan as $produkevent)
      @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
          <div class="rounded mb-2 eventPlaceholder bg-warning mySlidesEvent fadeEvent">
              <div class="eventcircle1 bg-warning" style="font-family: asparagus sprouts; font-size: 20px">Harga Diskon <p class="bg-danger rounded text-white eventprice">{{number_format($produkevent->Produk->harga_produk-($produkevent->Produk->harga_produk*$produkevent->discount/100))}} IDR</p></div>
              <div class="eventcircle2 bg-warning" style="font-family: asparagus sprouts; font-size: 20px">Harga Normal <p class="bg-danger rounded text-white eventprice"  style="text-decoration: line-through">{{number_format($produkevent->Produk->harga_produk)}} IDR</p></div>
              <div class="eventcircle3 bg-warning"><a href="{{ route('addkeranjang', ['id_produk' => $produkevent->id_produk])}}" class="btn btn-danger float-right mr-1 animateBtn eventbuy">Add To Cart <i class="fa fa-utensils"></i></a></div>
              <!-- <div class="eventrectangle bg-danger"></div> -->
              <div class="eventsun bg-warning"><p class="eventtitle">{{$produkevent->Kegiatan->nama_kegiatan}}</p><p class="eventdesc">{{$produkevent->Kegiatan->deskripsi}}</p></div>
          <img src="{{ asset('/imageforuser/menu/'. $produkevent->Produk->gambar_produk) }}" style="width: 100%;">
          </div>
      @endif
    @endforeach
  </div>
  <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2 d-none d-lg-block d-xl-none d-xl-block">
    <div class="spinner2 d-none d-xl-block">
      <div class="cube1"></div>
      <div class="cube2"></div>
    </div>
    <div class="sk-cube-grid">
      <div class="sk-cube sk-cube1"></div>
      <div class="sk-cube sk-cube2"></div>
      <div class="sk-cube sk-cube3"></div>
      <div class="sk-cube sk-cube4"></div>
      <div class="sk-cube sk-cube5"></div>
      <div class="sk-cube sk-cube6"></div>
      <div class="sk-cube sk-cube7"></div>
      <div class="sk-cube sk-cube8"></div>
      <div class="sk-cube sk-cube9"></div>
    </div>
  </div>
</div>

<div class="row no-gutters p-0">
  @foreach($data as $makanan)
  @if($makanan->KategoriProduk->nama_kategori == 'Makanan')
  <div class="col-12 mySlidesMakanan fadeMakanan">
    <div class="row no-gutters p-0">
      <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
          <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" style="width:100%">
      </div>
      <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7">
      <p class="HeadMakanan d-flex justify-content-center">Makanan</p>
      <div class="iconMakanan"><img src="{{ asset ('imageforuser/egg.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="p-5">
          <div class="row no-gutters p-0">
            <div class="col-12 d-flex justify-content-center">
              <span class="badge badge-danger"><h6> {{$makanan->nama_produk}} </h6></span>
            </div>
            <div class="col-12 d-flex justify-content-center pr-5 pl-5 pt-3 pb-3">
              <p>
                {{$makanan->deskripsi_produk}}
              </p>
              <div class="slidemakan1 bg-light" style="z-index: -1;"></div>
              <div class="slidemakan2 bg-light" style="z-index: -1;"></div>
              <div class="slidemakan3 bg-light" style="z-index: -1;"></div>
              <div class="slidemakan4 bg-light" style="z-index: -1;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endforeach

</div>

<div class="col-12 p-5 bg-light">
  <div class="row no-gutters d-md-flex justify-content-center">
    <div class="col-sm-12 col-md-8 col-lg-4 col-xl-4 p-5 zoom bg-white">
      <h3 class="text-success">0878-0898-8059</h3>
      <h6 class="aboutHead mt-4">CALL FOR ORDER</h6>
      <p class="aboutContent mt-4">
        Jika kamu tidak ingin memesan lewat website kami, 
        anda bisa menelepon kami pada nomor yang tertera.
      </p>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-4 col-xl-4 p-5 zoom bg-white">
      <i class="text-success fa fa-utensils fa-3x"></i>
      <h6 class="aboutHead mt-4">DO YOU WANT MAKE AN ORDER HERE?</h6>
      <p class="aboutContent mt-4">
        Jika kamu ingin memesan lewat website kami, 
        anda bisa klik <i>"Order Now"</i>.
      </p>
      <a href="{{ route('menu') }}"><button class="btn btn-success my- my-sm-0" type="submit">Order Now <i class="fa fa-shopping-cart"></i></button></a>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-4 col-xl-4 p-5 zoom bg-white">
      <i class="text-success fa fa-clock fa-3x"></i>
      <h6 class="aboutHead mt-4">OPENING HOURS</h6>
      <p class="aboutContent mt-4">
        Sabtu - Kamis : <b>10.00 - 08.30</b> <br>
        Jumat : <b>Setelah Sholat Jumat</b>
      </p>
      <button class="btn btn-outline-success my- my-sm-0" data-toggle="modal" data-target="#exampleModalCenter" type="submit"><i>Contact Us</i></button>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
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
</div>

<div class="row no-gutters p-0">
  @foreach($data as $minuman)
  @if($minuman->KategoriProduk->nama_kategori == 'Minuman')
  <div class="col-12 mySlidesMinuman fadeMinuman">
    <div class="row no-gutters p-0">
      <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7">
        <p class="HeadMinuman d-flex justify-content-center">Minuman</p>
        <div class="iconMinuman"><img src="{{ asset ('imageforuser/drink1.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="p-5">
          <div class="row no-gutters p-0">
            <div class="col-12 d-flex justify-content-center">
              <span class="badge badge-primary"><h6> {{$minuman->nama_produk}} </h6></span>
            </div>
            <div class="col-12 d-flex justify-content-center pr-5 pl-5 pt-3 pb-3">
              <p>
                {{$minuman->deskripsi_produk}}
              </p>
              <div class="slideminum1 bg-light" style="z-index: -1;"></div>
              <div class="slideminum2 bg-light" style="z-index: -1;"></div>
              <div class="slideminum3 bg-light" style="z-index: -1;"></div>
              <div class="slideminum4 bg-light" style="z-index: -1;"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
        <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" style="width:100%;">
      </div>
    </div>
  </div>
  @endif
  @endforeach

</div>

<div class="col-12 p-5 bg-light">
  <div class="col-12 d-flex justify-content-center"><i class="fa fa-utensils fa-3x text-dark"></i>&nbsp;&nbsp;<h1 class="text-dark menuHeader">Our Menu's</h1>&nbsp;&nbsp;<i class="fa fa-utensils fa-3x text-dark"></i></div>
  <div class="col-12 d-flex justify-content-center mt-3">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link" id="pills-makanan-tab" data-toggle="pill" href="#pills-makanan" role="tab" aria-controls="pills-makanan" aria-selected="false">Makanan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" id="pills-semua-tab" data-toggle="pill" href="#pills-semua" role="tab" aria-controls="pills-semua" aria-selected="true">Semua Kategori</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-minuman-tab" data-toggle="pill" href="#pills-minuman" role="tab" aria-controls="pills-minuman" aria-selected="false">Minuman</a>
      </li>
    </ul>
    <!-- <div class="btn-group" role="group" id="myFilterMenu">
      <button type="button" class="btn btn-warning" onclick="filterSelection('makanan')">Makanan</button>
      <button type="button" class="btn btn-primary active" onclick="filterSelection('all')">Semua Menu</button>
      <button type="button" class="btn btn-success" onclick="filterSelection('minuman')">Minuman</button>
    </div> -->
  </div>
  <div class="col-12 mt-3">
    <div class="row">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade" id="pills-makanan" role="tabpanel" aria-labelledby="pills-makanan-tab">
          @foreach($datamkn as $makanan)
            @if($makanan->KategoriProduk->nama_kategori == 'Makanan')
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 column makanan">
              <div class="card border-success" style="width: 100%;">
                  <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" class="card-img-top d-none d-sm-none d-md-none d-lg-none d-lg-block d-xl-none d-xl-block menu-image menu-image-xlf menu-image-lgf" alt="...">
                  <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" class="d-none d-sm-none d-md-none d-md-block d-lg-none d-xl-none" height="250px" alt="...">
                  <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" class="card-img-top d-sm-none d-sm-block d-md-none d-lg-none d-xl-none menu-image-smf" alt="...">
                <div class="card-body">
                  <strong>
                    <p class="card-title" style="font-family: asparagus sprouts; font-size: 24px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      {{$makanan->nama_produk}}
                    </p>
                  </strong>
                  <p class="card-title" style="font-size: 14px; font-family: raleway; white-space: nowrap; width: 215px; overflow: hidden; text-overflow: ellipsis;">
                    {{$makanan->deskripsi_produk}}
                  </p>
                  <hr style="width: 100%">
                  <a href="{{ route('detailproduk', $makanan->id_produk)}}" class="btn btn-outline-success float-right animateBtn">
                    <span>See Detail <i class="fa fa-info-circle"></i></span>
                  </a>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        </div>
        <!-- semua -->
        <div class="tab-pane fade show active" id="pills-semua" role="tabpanel" aria-labelledby="pills-semua-tab">
          @foreach($datamkn as $makanan)
            @if($makanan->KategoriProduk->nama_kategori == 'Makanan')
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 column makanan">
              <div class="card border-success" style="width: 100%;">
                  <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" class="card-img-top d-none d-sm-none d-md-none d-lg-none d-lg-block d-xl-none d-xl-block menu-image menu-image-xlf menu-image-lgf" alt="...">
                  <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" class="d-none d-sm-none d-md-none d-md-block d-lg-none d-xl-none" height="250px" alt="...">
                  <img src="{{ asset('/imageforuser/menu/'. $makanan->gambar_produk) }}" class="card-img-top d-sm-none d-sm-block d-md-none d-lg-none d-xl-none menu-image-smf" alt="...">
                <div class="card-body">
                  <strong>
                    <p class="card-title" style="font-family: asparagus sprouts; font-size: 24px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      {{$makanan->nama_produk}}
                    </p>
                  </strong>
                  <p class="card-title" style="font-size: 14px; font-family: raleway; white-space: nowrap; width: 215px; overflow: hidden; text-overflow: ellipsis;">
                    {{$makanan->deskripsi_produk}}
                  </p>
                  <hr style="width: 100%">
                  <a href="{{ route('detailproduk', $makanan->id_produk)}}" class="btn btn-outline-success float-right animateBtn">
                    <span>See Detail <i class="fa fa-info-circle"></i></span>
                  </a>
                </div>
              </div>
            </div>
            @endif
          @endforeach
          
          @foreach($datamnm as $minuman)
            @if($minuman->KategoriProduk->nama_kategori == 'Minuman')
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 column minuman">
              <div class="card border-success" style="width: 100%;">
                  <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" class="card-img-top d-none d-sm-none d-md-none d-lg-none d-lg-block d-xl-none d-xl-block menu-image menu-image-xlf menu-image-lgf" alt="...">
                  <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" class="d-none d-sm-none d-md-none d-md-block d-lg-none d-xl-none" height="250px" alt="...">
                  <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" class="card-img-top d-sm-none d-sm-block d-md-none d-lg-none d-xl-none menu-image-smf" alt="...">
                <div class="card-body">
                  <strong>
                    <p class="card-title" style="font-family: asparagus sprouts; font-size: 24px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      {{$minuman->nama_produk}}
                    </p>
                  </strong>
                  <p class="card-title" style="font-size: 14px; font-family: raleway; white-space: nowrap; width: 215px; overflow: hidden; text-overflow: ellipsis;">
                    {{$minuman->deskripsi_produk}}
                  </p>
                  <hr style="width: 100%">
                  <a href="{{ route('detailproduk', $minuman->id_produk)}}" class="btn btn-outline-success float-right animateBtn">
                    <span>See Detail <i class="fa fa-info-circle"></i></span>
                  </a>
                </div>
              </div>
            </div>
            @endif
          @endforeach
        </div>
        <!-- end semua -->
        <div class="tab-pane fade" id="pills-minuman" role="tabpanel" aria-labelledby="pills-minuman-tab">
          @foreach($datamnm as $minuman)
          @if($minuman->KategoriProduk->nama_kategori == 'Minuman')
          <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 column minuman">
            <div class="card border-success" style="width: 100%;">
                <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" class="card-img-top d-none d-sm-none d-md-none d-lg-none d-lg-block d-xl-none d-xl-block menu-image menu-image-xlf menu-image-lgf" alt="...">
                <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" class="d-none d-sm-none d-md-none d-md-block d-lg-none d-xl-none" height="250px" alt="...">
                <img src="{{ asset('/imageforuser/menu/'. $minuman->gambar_produk) }}" class="card-img-top d-sm-none d-sm-block d-md-none d-lg-none d-xl-none menu-image-smf" alt="...">
              <div class="card-body">
                <strong>
                  <p class="card-title" style="font-family: asparagus sprouts; font-size: 24px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    {{$minuman->nama_produk}}
                  </p>
                </strong>
                <p class="card-title" style="font-size: 14px; font-family: raleway; white-space: nowrap; width: 215px; overflow: hidden; text-overflow: ellipsis;">
                  {{$minuman->deskripsi_produk}}
                </p>
                <hr style="width: 100%">
                <a href="{{ route('detailproduk', $minuman->id_produk)}}" class="btn btn-outline-success float-right animateBtn">
                  <span>See Detail <i class="fa fa-info-circle"></i></span>
                </a>
              </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>

    </div>
  </div>
</div>

<div class="row no-gutters p-0" id="lokasi">
  <div class="col-12 pt-1">
    <div class="mapouter">
      <div class="gmap_canvas">
        <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Pecak%20Bandeng%2059&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        <a href="https://www.pureblack.de/webdesign/"></a>
      </div>
    </div>
  </div>
</div>

@endsection