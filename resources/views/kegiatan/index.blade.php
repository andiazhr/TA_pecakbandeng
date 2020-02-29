@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kegiatan Table</h3> 
              <form role="form" method="post" action="{{ route('submit.kegiatan') }}" enctype="multipart/form-data">
              <div class="box-body">
              @csrf
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tambah Kegiatan</label>
                    <input type="text" required class="form-control{{ $errors->has('nama_kegiatan') ? ' is-invalid' : '' }}" name="nama_kegiatan" required placeholder="Masukkan Kegiatan" value="{{ old('nama_kegiatan') }}">
                    @if ($errors->has('nama_kegiatan'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('nama_kegiatan') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-xs-5 col-md-5 nopadding">
                    <div class="form-group">
                      <label>Periode Awal:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="periode_awal" value="<?php echo date('m/d/Y')?>" class="form-control pull-right" id="datepicker">
                      </div>
                        <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-xs-2 col-md-2">
                    <i class="fas fa-exchange-alt" style="padding: 35px 0 0 15px;"></i>
                  </div>
                  <div class="col-xs-5 col-md-5 nopadding">
                    <div class="form-group">
                      <label>Periode Akhir:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="periode_akhir" value="<?php echo date('m/d/Y')?>" class="form-control pull-right" id="datepicker2">
                      </div>
                        <!-- /.input group -->
                    </div>
                </div>

                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Deskripsi Kegiatan</label>
                      <textarea type="text" required rows="2" minlength=20 maxlength=75 class="form-control" name="deskripsi" placeholder="Masukkan Deskripsi Kegiatan">{{ old('deskripsi') }}</textarea>
                  </div>
                </div>
                
                <div class="col-md-6 btn-kegiatan" style="text-align: right">
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
                  <th>Nama Kegiatan</th>
                  <th>Deskripsi Kegiatan</th>
                  <th style="text-align: center;">Periode Awal Kegiatan</th>
                  <th style="text-align: center;">Periode Akhir Kegiatan</th>
                  <th colspan="4" style="text-align: center;">Aksi</th>
                </tr>
                @foreach($data as $no => $kegiatan)
                    @if(Carbon\Carbon::now()->between(Carbon\Carbon::parse($kegiatan->periode_awal), Carbon\Carbon::parse($kegiatan->periode_akhir)))
                    
                    @endif
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{ucwords($kegiatan->nama_kegiatan)}}</td>
                  <td>{{$kegiatan->deskripsi}}</td>
                  <td style="text-align: center;">{{$kegiatan->periode_awal}}</td>
                  <td style="text-align: center;">{{$kegiatan->periode_akhir}}</td>
                  <td style="text-align: right;">
                    <a href="{{ route('add.createProdukKegiatan', $kegiatan->id_kegiatan)}}">
                      <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </a>
                  </td>
                  <td style="text-align: center;">
                    <a href="{{ route('edit.kegiatan', $kegiatan->id_kegiatan)}}">
                      <button type="button" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                    </a>
                  </td>
                  <td style="text-align: center;">
                    <a href="{{ route('detail.kegiatan', $kegiatan->id_kegiatan)}}">
                      <button type="button" class="btn btn-info"><i class="fa fa-info"></i></button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('delete.kegiatan', $kegiatan->id_kegiatan)}}" method="post">
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