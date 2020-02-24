@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Kategori Produk Table</h3> 
              <form role="form" method="post" action="{{ route('submit.kategoriProduk') }}" enctype="multipart/form-data">
              <div class="box-body">
              @csrf
                <div class="col-md-5">
                    <div class="form-group">
                      <label>Tambah Kategori Produk</label>
                      <input type="text" class="form-control{{ $errors->has('nama_kategori') ? ' is-invalid' : '' }}" name="nama_kategori" required placeholder="Masukkan Kategori Produk" value="{{ old('nama_kategori') }}">
                      @if ($errors->has('nama_kategori'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama_kategori') }}</strong>
                        </span>
                      @endif
                    </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label class="mb-kategori">Untuk Tampilan</label><br>
                      <input type="radio" name="status" class="flat-red" value="1">
                      Ditampilkan
                      <input type="radio" name="status" class="flat-red" value="0" style="margin-left: 20px">
                      Tidak Ditampilkan
                  </div>
                </div>
                
                <div class="col-md-2 mt-kategori" style="text-align: right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </form>

            @if(session()->get('success'))
                <div class="col-12 d-flex justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align:center; font-size:16px; margin-top:10px;">
                        <div class="alert alert-default">
                            {{ session()->get('success') }} <img src="{{ asset ('/imageforuser/checked5.png') }}" alt="Jet" style="width:30px;height:30px;">
                        </div>
                    </div>
                </div>
              @endif

            @if(session()->get('fail'))
                <div class="col-12 d-flex justify-content-center">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align:center; font-size:16px; margin-top:10px;">
                        <div class="alert alert-default">
                            {{ session()->get('fail') }} <img src="{{ asset ('/imageforuser/cancel2.png') }}" alt="Jet" style="width:30px;height:30px;">
                        </div>
                    </div>
                </div>
              @endif
              
              <div class="box-tools">
                <form action="{{ url()->current() }}">
                  <div class="input-group input-group-sm" style="width: 200px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ app('request')->input('search') }}">

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
                  <th>Kategori Produk</th>
                  <th style="text-align: center;">Status</th>
                  <th style="text-align: center; width: 190px">Aksi</th>
                </tr>
                @foreach($data as $no => $kategori)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$kategori->nama_kategori}}</td>
                  <td style="text-align: center;">
                    @if($kategori->status == 1)
                        <button type="submit" class="btn btn-xs btn-success">Ditampilkan</button>
                      @else
                        <button type="submit" class="btn btn-xs btn-danger">Tidak Ditampilkan</button>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('edit.kategoriProduk', $kategori->id_kategori)}}">
                      <button type="button" class="btn btn-sm btn-warning" style="float: left;"><i class="fa fa-edit"></i></button>
                    </a>
                    @if($kategori->status == 1)
                      <form action="{{ route('status.kategoriProduk', $kategori->id_kategori)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="0">
                        <button type="submit" class="btn btn-sm btn-primary" style="float: left; margin-left: 10px;">Ubah Status</button>
                      </form>
                      @else
                      <form action="{{ route('status.kategoriProduk', $kategori->id_kategori)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="1">
                        <button type="submit" class="btn btn-sm btn-danger" style="float: left; margin-left: 10px;">Ubah Status</button>
                      </form>
                    @endif
                    <form action="{{ route('delete.kategoriProduk', $kategori->id_kategori)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-sm btn-danger" style="float: left; margin-left: 10px;"><i class="fa fa-trash"></i></button>
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