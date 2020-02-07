@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Stok Produk Table</h3> 
              <form role="form" method="post" action="{{ route('update.stok', $stok->id_stok) }}" enctype="multipart/form-data">
              <div class="box-body">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Ubah Nama Barang</label>
                      <input type="text" class="form-control" name="nama_barang" value="{{$stok->nama_barang}}">
                    </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="">Stok</label>
                      <input type="number" class="form-control" name="stok" required placeholder="Masukkan stok" value="{{ $stok->stok }}">
                  </div>
                </div>
                
                <div class="col-md-12" style="clear: left; text-align: right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
                    <a href="{{ url('Stok') }}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </form>
            <!-- /.box-header -->
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