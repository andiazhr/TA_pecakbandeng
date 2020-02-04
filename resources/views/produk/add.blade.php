<html>
<body>
@extends('Layouts.master')
@section('content')
    <section class="content-header">
      <h1>
        Form Tambah Produk
        <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('produk') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('produk/add') }}">Tambah</a></li>
        <li class="active">Produk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Produk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('submit.produk') }}" enctype="multipart/form-data">
              <div class="box-body">
              
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
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
          
          @if(session()->get('error'))
              <div class="col-12 d-flex justify-content-center">
                  <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align:center; font-size:16px;">
                      <div class="alert alert-danger">
                          {{ session()->get('error') }} <img src="{{ asset ('/imageforuser/attention.png') }}" alt="Jet" style="width:30px;height:30px;">
                      </div>
                  </div>
              </div>
          @endif
          
              @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control{{ $errors->has('nama_produk') ? ' is-invalid' : '' }}" name="nama_produk" placeholder="Masukkan Nama Produk" value="{{ old('nama_produk') }}">
                        @if ($errors->has('nama_produk'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('nama_produk') }}</strong>
                          </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Masukkan Gambar Produk</label>
                        <input type="file" name="gambar_produk[]" class="form-control">

                        <p class="help-block">Ukuran gambar max 2mb.</p>
                    </div>

                    <div class="form-group mt-produk">
                        <label>Harga Produk</label>
                        <input type="number" class="form-control{{ $errors->has('harga_produk') ? ' is-invalid' : '' }}" name="harga_produk" placeholder="Masukkan Harga Produk" value="{{ old('harga_produk') }}">
                    </div>
                </div>
                  
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select id="kategori" name="id_kategori" class="form-control select2" style="width: 100%;">
                            <option selected="-" disabled selected>Pilih Kategori Produk</option>
                            @foreach($data as $kategori)
                            <option value="{{$kategori->id_kategori}}|{{$kategori->nama_kategori}}">{{$kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea type="text" rows="3" class="form-control{{ $errors->has('deskripsi_produk') ? ' is-invalid' : '' }}" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk">{{ old('deskripsi_produk') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Stok Produk</label>
                        <input type="number" class="form-control{{ $errors->has('bobot_produk') ? ' is-invalid' : '' }}" name="stok_produk" placeholder="Masukkan Bobot Produk" value="{{ old('stok_produk') }}">
                    </div>
                    <!-- /.input group -->
                </div>
              <!-- /.box-body -->

              <div class="box-footer" style="float: left; clear: left;">
                <a href="{{ url('produk') }}" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
  @endsection

</body>
</html>