<html>
<body>
@extends('Layouts.master')
@section('content')
    <section class="content-header">
      <h1>
        Form Edit Produk
        <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('produk') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('produk/add') }}">Edit</a></li>
        <li class="active">Produk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Produk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('update.produk', $produk->id_produk) }}" enctype="multipart/form-data">
              <div class="box-body">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control{{ $errors->has('nama_produk') ? ' is-invalid' : '' }}" name="nama_produk" placeholder="Masukkan Nama Produk" value="{{$produk->nama_produk}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar Produk Sebelumnya</label><br>
                        <img src="{{ asset('/imageforuser/menu/'. $produk->gambar_produk) }}" alt="" width="200px" height="136px">
                    </div>
                    
                    <div class="form-group mt-produk-edit">
                        <label for="exampleInputFile">Masukkan Gambar Produk</label>
                        <input type="file" name="gambar_produk[]" class="form-control">

                        <p class="help-block">Ukuran gambar max 2mb.</p>
                    </div>
                </div>
                  
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select id="kategori" name="id_kategori" class="form-control select2" style="width: 100%;">
                            <option selected="-" disabled selected>Pilih Kategori Produk</option>
                            @foreach($data as $kategori)
                            <option value="{{$kategori->id_kategori}}|{{$kategori->nama_kategori}}"<?=$produk['id_kategori'] == $kategori['id_kategori'] ? ' selected="selected"' : '';?>>{{$kategori->nama_kategori}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea type="text" rows="3" class="form-control" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk">{{$produk->deskripsi_produk}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Harga Produk</label>
                        <input type="number" class="form-control" name="harga_produk" placeholder="Masukkan Harga Produk" value="{{$produk->harga_produk}}">
                    </div>
                    
                    <div class="form-group">
                        <label>Stok Produk</label>
                        <input type="number" class="form-control" name="stok_produk" placeholder="Masukkan Bobot Produk" value="{{$produk->stok_produk}}">
                    </div>
                    <!-- /.input group -->
                </div>
              <!-- /.box-body -->

              <div class="box-footer col-md-12">
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