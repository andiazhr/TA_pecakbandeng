@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Pengeluaran Table</h3> 
              <form role="form" method="post" action="{{ route('update.pengeluaran', $pengeluaran->id_pengeluaran) }}" enctype="multipart/form-data">
              <div class="box-body">
                @csrf
                @method('PUT')
                <div class="col-md-3">
                    <div class="form-group">
                      <label>Ubah Nama Barang</label>
                      <input type="text" class="form-control" name="nama_barang" value="{{$pengeluaran->nama_barang}}">
                    </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="">Total Pengeluaran</label>
                      <input type="number" class="form-control" name="total" required value="{{ $pengeluaran->total }}">
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tanggal Pengeluaran:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal" value="<?php echo date('m/d/Y', strtotime($pengeluaran->tanggal))?>" class="form-control pull-right" id="datepicker">
                    </div>
                      <!-- /.input group -->
                  </div>
                </div>
                
                <div class="col-md-3 mt-stok-edit" style="text-align: right">
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