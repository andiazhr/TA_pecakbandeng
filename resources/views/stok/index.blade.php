@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Stok Table</h3> 
              <form role="form" method="post" action="{{ route('submit.stok') }}" enctype="multipart/form-data">
              <div class="box-body">
              @csrf
                <div class="col-md-3">
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" class="form-control{{ $errors->has('nama_barang') ? ' is-invalid' : '' }}" name="nama_barang" required placeholder="Contoh: Ayam atau Bandeng" value="{{ old('nama_barang') }}">
                      @if ($errors->has('nama_barang'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nama_barang') }}</strong>
                        </span>
                      @endif
                    </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="">Stok</label>
                      <input type="number" class="form-control{{ $errors->has('stok') ? ' is-invalid' : '' }}" name="stok" required placeholder="Masukkan stok" value="{{ old('stok') }}">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('stok') }}</strong>
                        </span>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="mb-kategori">Status Bahan Lain</label><br>
                      <input type="radio" name="status" class="flat-red" value="1">
                      Tersedia
                      <input type="radio" name="status" class="flat-red" value="0" style="margin-left: 20px">
                      Tidak Tersedia
                  </div>
                </div>
                
                <div class="col-md-2 mt-stok" style="text-align: right">
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
                  <th>Nama Bahan Utama</th>
                  <th>Stok</th>
                  <th style="text-align: center;">Status Bahan Lain</th>
                  <th style="text-align: center; width: 220px">Aksi</th>
                </tr>
                @foreach($data as $no => $stok)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{ucwords($stok->nama_barang)}}</td>
                  <td>{{$stok->stok}}</td>
                  <td style="text-align: center">
                    @if($stok->status == 1)
                        <button type="submit" class="btn btn-xs btn-success">Tersedia</button>
                      @else
                        <button type="submit" class="btn btn-xs btn-danger">Tidak Tersedia</button>
                    @endif
                  </td>
                  <td style="text-align: center;">
                    @if($stok->status == 1)
                      <form action="{{ route('status.stok', $stok->id_stok)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" value="0">
                        <button type="submit" class="btn btn-sm btn-primary">Ubah Status</button>
                      </form>
                      @else
                      <form action="{{ route('status.stok', $stok->id_stok)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="1">
                        <button type="submit" class="btn btn-sm btn-danger">Ubah Status</button>
                      </form>
                    @endif
                    <a href="{{ route('edit.stok', $stok->id_stok)}}">
                      <button type="button" class="btn btn-sm btn-warning" style="margin-top: 5px;"><i class="fa fa-edit"></i></button>
                    </a>
                    <form action="{{ route('delete.stok', $stok->id_stok)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-sm btn-danger" style="margin-top: 5px;"><i class="fa fa-trash"></i></button>
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