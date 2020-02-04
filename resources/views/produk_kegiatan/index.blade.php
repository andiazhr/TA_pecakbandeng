@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Produk Kegiatan Table</h3>
              
              <form role="form" method="post" action="{{ route('submit.storeProdukKegiatan', Request::segment(3)) }}" enctype="multipart/form-data">
              <div class="box-body">
              @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <select id="kegiatan" name="id_kegiatan" class="form-control select2" style="width: 100%;">
                            <option selected="-" disabled selected>Pilih Kegiatan</option>
                            @foreach($datakegiatan as $kegiatan)
                            <option value="{{$kegiatan->id_kegiatan}}|{{$kegiatan->nama_kegiatan}}"<?=$kegiatan['id_kegiatan'] == Request::segment(3) ? ' selected="selected"' : '';?>>{{$kegiatan->nama_kegiatan}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Produk Kegiatan</label>
                        <select id="produk" name="id_produk" class="form-control select2" style="width: 100%;">
                            <option selected="-" disabled selected>Pilih Produk</option>
                            @foreach($dataproduk as $produk)
                            <option value="{{$produk->id_produk}}|{{$produk->nama_produk}}">{{$produk->nama_produk}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label>Diskon Produk</label>
                      <input type="number" required class="form-control" name="discount" placeholder="Masukkan Diskon" value="{{ old('discount') }}">
                      <small style="color: red;">* Isi diskon antara 0-100</small>
                  </div>
                </div>
                <div class="col-md-6" style="clear: left; text-align:right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <a href="{{ url('kegiatan') }}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                </div>
              </div>
              </form>
              
              <div class="box-footer">
              </div>

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
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <tr>
                  <th>No</th>
                  <th>Nama Kegiatan</th>
                  <th>Nama Produk</th>
                  <th>Diskon(%)</th>
                  <th colspan="2" style="text-align: center;">Action</th>
                </tr>
                @foreach($data as $no => $produkKegiatan)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$produkKegiatan->Kegiatan->nama_kegiatan}}</td>
                  <td>{{$produkKegiatan->Produk->nama_produk}}</td>
                  <td>{{$produkKegiatan->discount}}</td>
                  <td style="text-align: right;">
                    <a href="{{ route('edit.produkKegiatan', $produkKegiatan->id_produk_kegiatan)}}">
                      <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('delete.produkKegiatan', $produkKegiatan->id_produk_kegiatan)}}" method="post">
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