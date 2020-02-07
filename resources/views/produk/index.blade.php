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
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <tr>
                  <th>No</th>
                  <th>Nama Produk</th>
                  <th>Kategori Produk</th>
                  <th>Gambar Produk</th>
                  <th>Deskripsi Produk</th>
                  <th>Harga Produk(Rp)</th>
                  <th>Stok Produk</th>
                  <th>Status</th>
                  <th colspan="2" style="text-align: center;">Action</th>
                </tr>
                @foreach($data as $no => $produk)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$produk->nama_produk}}</td>
                  <td>{{$produk->KategoriProduk->nama_kategori}}</td>
                  <td><img src="{{ asset('/imageforuser/menu/'. $produk->gambar_produk) }}" alt="" width="150px" height="100px"></td>
                  <td>{{$produk->deskripsi_produk}}</td>
                  <td>{{number_format($produk->harga_produk)}}</td>
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
                    <form action="{{ route('status.produk', $produk->id_produk)}}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="number" hidden name="status" id="status" value="0">
                      <button type="submit" class="btn btn-xs btn-primary">Ditampilkan</button>
                    </form>
                    @else
                    <form action="{{ route('status.produk', $produk->id_produk)}}" method="post">
                      @csrf
                      @method('PUT')
                      <input type="number" hidden name="status" id="status" value="1">
                      <button type="submit" class="btn btn-xs btn-danger">Tidak Ditampilkan</button>
                    </form>
                    @endif
                  </td>
                  <td style="text-align: right;">
                    <a href="{{ route('edit.produk', $produk->id_produk)}}">
                      <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('delete.produk', $produk->id_produk)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
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