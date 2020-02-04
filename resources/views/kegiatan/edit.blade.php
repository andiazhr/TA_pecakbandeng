@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Edit Kegiatan Table</h3> 
              <form role="form" method="post" action="{{ route('update.kegiatan', $kegiatan->id_kegiatan) }}" enctype="multipart/form-data">
              <div class="box-body">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Ubah Kegiatan</label>
                    <input type="text" class="form-control" name="nama_kegiatan" placeholder="Masukkan Kegiatan" value="{{$kegiatan->nama_kegiatan}}">
                  </div>
                  
                  <div class="form-group">
                    <label>Ubah Deskripsi Kegiatan</label>
                    <textarea type="text" required rows="3" minlength=20 maxlength=75 class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi">{{$kegiatan->deskripsi}}</textarea>
                  </div>

                  <div class="col-xs-5 col-md-5 nopadding">
                  <div class="form-group">
                    <label>Ubah Periode Awal:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="periode_awal" value="<?php echo date('m/d/Y', strtotime($kegiatan->periode_awal))?>" class="form-control pull-right" id="datepicker">
                    </div>
                      <!-- /.input group -->
                  </div>
                </div>
                <div class="col-xs-2 col-md-2">
                  <i class="fas fa-exchange-alt" style="padding: 35px 0 0 15px;"></i>
                </div>
                <div class="col-xs-5 col-md-5 nopadding">
                  <div class="form-group">
                    <label>Ubah Periode Akhir:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="periode_akhir" value="<?php echo date('m/d/Y', strtotime($kegiatan->periode_akhir))?>" class="form-control pull-right" id="datepicker2">
                    </div>
                      <!-- /.input group -->
                  </div>
                </div>
                
                </div>
                <div class="col-md-6" style="clear: left; text-align: right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
                    <a href="{{ url('kegiatan') }}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </form>
            </div>
            <!-- /.box-header -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection