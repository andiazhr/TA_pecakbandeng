@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Produk Table</h3> <a href="{{route('add.produk')}}"><button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button></a>
              
              @if(session()->get('success'))
                <div class="col-12 d-flex justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align:center; font-size:16px; margin-top:10px;">
                        <div class="alert alert-default">
                            {{ session()->get('success') }} <img src="{{ asset ('/imageforuser/checked5.png') }}" alt="Jet" style="width:30px;height:30px;">
                        </div>
                    </div>
                </div>
              @endif
              
              <div class="box-tools">
                <form action="{{ url()->current() }}">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search"  value="{{ app('request')->input('search') }}">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped table-bordered">
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Kategori Produk</th>
                  <th>Gambar Produk</th>
                  <th>Deskripsi Produk</th>
                  <th>Harga Produk(IDR)</th>
                  <th>Stok Produk</th>
                  <th style="text-align: center">Status</th>
                  <th style="text-align: center;">Review</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
                @foreach($data as $no => $produk)
                <?php $check = 0 ?>
                <?php $checkrating = 0 ?>
                <?php $checklike = 0 ?>
                <?php $checkreview = 0 ?>
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$produk->nama_produk}}</td>
                  <td>{{$produk->KategoriProduk->nama_kategori}}</td>
                  <td><img src="{{ asset('/imageforuser/menu/'. $produk->gambar_produk) }}" alt="" width="150px" height="100px"></td>
                  <td>{{$produk->deskripsi_produk}}</td>
                  <td >
                  @foreach($produk->ProdukKegiatan as $produkevent)
                    @if($produkevent->Kegiatan->periode_awal <= Carbon\Carbon::now()->format('Y-m-d') && $produkevent->Kegiatan->periode_akhir >= Carbon\Carbon::now()->format('Y-m-d'))
                        @if($produk->id_produk == $produkevent->id_produk)
                            <?php $check++ ?>
                            <button readonly type="button" class="btn btn-md btn-warning">{{number_format($produk->harga_produk - ($produk->harga_produk*$produkevent->discount/100))}}</button>
                        @endif
                    @endif
                  @endforeach
                  @if($check == 0)
                    <button readonly type="button" class="btn btn-md btn-primary">{{number_format($produk->harga_produk)}}</button>
                  @endif
                  </td>
                  <td>
                    @if($produk->id_stok == NULL)
                        <span class="label label-success">Stok tersedia</span>
                    @else
                      @if($produk->Stok->stok == 0)  
                        <span class="label label-danger">Stok habis</span>
                      @elseif($produk->Stok->stok <= 5)
                        <span class="label label-warning">{{$produk->Stok->stok}}</span>
                      @else
                        <span class="label label-success">{{$produk->Stok->stok}}</span>
                      @endif
                    @endif  
                  </td>
                  <td>
                    @if($produk->status == 1)
                      <button type="submit" class="btn btn-xs btn-success">Ditampilkan</button>
                    @else
                      <button type="submit" class="btn btn-xs btn-danger">Tidak Ditampilkan</button>
                    @endif
                  </td>
                  <td >
                    @if($countrating == 0)
                      <div class="col-md-12" style="text-align: center;">
                        <i class="fa fa-star fa-lg" style="color: #f39c12;"></i> 3
                      </div>
                    @else
                      @foreach($rating as $star)
                              @if($star->id_produk == $produk->id_produk)
                              <?php $checkrating++ ?>
                              <div class="col-md-12" style="text-align: center;">
                                <i class="fa fa-star fa-lg" style="color: #f39c12"></i> 
                                  {{round(($star->hasil+3)/($star->total+1), 2)}}
                              </div>
                              @endif            
                          @endforeach
                          @if($checkrating == 0)
                            <div class="col-md-12" style="text-align: center;">
                              <i class="fa fa-star fa-lg" style="color: #f39c12"></i> 3
                            </div>
                          @endif
                    @endif

                    @if($countlike == 0)
                      <div class="col-md-12" style="text-align: center; margin-top: 10px">
                        <i class="fa fa-heart fa-lg" style="color: #dd4b39"></i> 0
                      </div>
                    @else
                      @foreach($like as $suka)
                            @if($suka->id_produk == $produk->id_produk)
                            <?php $checklike++ ?>
                            <div class="col-md-12" style="text-align: center; margin-top: 10px">
                              <i class="fa fa-heart fa-lg" style="color: #dd4b39"></i> 
                                {{$suka->total}}
                            </div>
                            @endif            
                        @endforeach
                        @if($checklike == 0)
                            <div class="col-md-12" style="text-align: center; margin-top: 10px">
                              <i class="fa fa-heart fa-lg" style="color: #dd4b39"></i> 0
                            </div>
                        @endif
                    @endif

                    @if($countreview == 0)
                      <div class="col-md-12" style="text-align: center; margin-top: 10px">
                        <i class="fa fa-comment fa-lg" style="color: #444"></i> 0
                      </div>
                    @else
                      @foreach($review as $ulasan)
                            @if($ulasan->id_produk == $produk->id_produk)
                            <?php $checklike++ ?>
                            <div class="col-md-12" style="text-align: center; margin-top: 10px">
                              <i class="fa fa-comment fa-lg" style="color: #444"></i> 
                                {{$ulasan->total}}
                            </div>
                            @endif            
                        @endforeach
                        @if($checklike == 0)
                            <div class="col-md-12" style="text-align: center; margin-top: 10px">
                              <i class="fa fa-comment fa-lg" style="color: #444"></i> 0
                            </div>
                        @endif
                    @endif
                  </td>
                  <td style="text-align: center;">
                    @if($produk->status == 1)
                      <form action="{{ route('status.produk', $produk->id_produk)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="0">
                        <button type="submit" class="btn btn-sm btn-primary">Ubah Status</button>
                      </form>
                      @else
                      <form action="{{ route('status.produk', $produk->id_produk)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="1">
                        <button type="submit" class="btn btn-sm btn-danger">Ubah Status</button>
                      </form>
                    @endif
                    <a href="{{ route('edit.produk', $produk->id_produk)}}">
                      <button type="button" class="btn btn-sm btn-warning" style="margin-top: 5px;"><i class="fa fa-edit"></i></button>
                    </a>
                    <form action="{{ route('delete.produk', $produk->id_produk)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-sm btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <p style="margin-left: 20px; margin-top:10px; color:#dd4b39; font-weight:bold;">Harga Sedang Promo : <span class="label label-warning">* IDR</span></p>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <span>{{$data->links()}}</span>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection