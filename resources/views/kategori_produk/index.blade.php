@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kategori Produk Table</h3> 
              <form role="form" method="post" action="{{ route('submit.kategoriProduk') }}" enctype="multipart/form-data">
              <div class="box-body">
              @csrf
                <div class="col-md-6">
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

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="mb-kategori">Untuk Tampilan</label><br>
                      <input type="radio" name="for_view" class="flat-red" value="Ditampilkan">
                      Ditampilkan dimenu
                      <input type="radio" name="for_view" class="flat-red" value="Tidak ditampilkan" style="margin-left: 20px">
                      Tidak ditampilkan dimenu
                  </div>
                </div>
                
                <div class="col-md-12" style="clear: left; text-align: right">
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
                  <th>Kategori Produk</th>
                  <th>Untuk Tampilan</th>
                  <th colspan="2" style="text-align: center;">Action</th>
                </tr>
                @foreach($data as $no => $kategori)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$kategori->nama_kategori}}</td>
                  <td>{{$kategori->for_view}}</td>
                  <td style="text-align: right;">
                    <a href="{{ route('edit.kategoriProduk', $kategori->id_kategori)}}">
                      <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('delete.kategoriProduk', $kategori->id_kategori)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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