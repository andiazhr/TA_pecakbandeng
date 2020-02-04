@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ubah Produk Kegiatan Table</h3> 
              <form role="form" method="post" action="{{ route('update.produkKegiatan', $data->id_produk_kegiatan) }}" enctype="multipart/form-data">
              <div class="box-body">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Ubah Nama Kegiatan</label>
                      <select id="kegiatan" name="id_kegiatan" class="form-control select2" style="width: 100%;">
                          <option selected="-" disabled selected>Pilih Kegiatan</option>
                          @foreach($datakegiatan as $kegiatan)
                          <option value="{{$kegiatan->id_kegiatan}}|{{$kegiatan->nama_kegiatan}}"<?=$data['id_kegiatan'] == $kegiatan['id_kegiatan'] ? ' selected="selected"' : '';?>>{{$kegiatan->nama_kegiatan}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label>Ubah Produk Kegiatan</label>
                      <select id="produk" name="id_produk" class="form-control select2" style="width: 100%;">
                          <option selected="-" disabled selected>Pilih Produk</option>
                          @foreach($dataproduk as $produk)
                          <option value="{{$produk->id_produk}}|{{$produk->nama_produk}}"<?=$data['id_produk'] == $produk['id_produk'] ? ' selected="selected"' : '';?>>{{$produk->nama_produk}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label>Ubah Diskon Produk</label>
                      <input type="number" required class="form-control" name="discount" placeholder="Masukkan Diskon" value="{{ $data->discount }}">
                      <small style="color: red;">* Isi diskon antara 0-100</small>
                  </div>
                </div>
                <div class="col-md-6" style="clear: left; text-align: right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
                    <a href="{{ route('add.createProdukKegiatan', $data->id_kegiatan)}}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                </div>
              </div>
            </form>
            <!-- /.box-header -->
            <div class="box-footer">
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection