@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Pengeluaran Table</h3> 
              <form role="form" method="post" action="{{ route('submit.pengeluaran') }}" enctype="multipart/form-data">
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
                    <label class="">Total Pembelian</label>
                      <input type="number" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" name="total" required placeholder="Masukkan total" value="{{ old('total') }}">
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('total') }}</strong>
                        </span>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tanggal Pengeluaran:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal" value="<?php echo date('m/d/Y')?>" class="form-control pull-right" id="datepicker">
                    </div>
                      <!-- /.input group -->
                  </div>
                </div>
                
                <div class="col-md-3 mt-pengeluaran" style="text-align: right">
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
                  <th>Nama Barang</th>
                  <th style="text-align: center">Tanggal</th>
                  <th style="text-align: right; padding-right: 25px">Total Pengeluaran(IDR)</th>
                  <th colspan="2" style="text-align: center;">Aksi</th>
                </tr>
                @foreach($data as $no => $pengeluaran)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$pengeluaran->nama_barang}}</td>
                  <td style="text-align: center"><?php echo date('d F Y', strtotime($pengeluaran->tanggal))?></td>
                  <td style="text-align: right; padding-right: 25px">{{number_format($pengeluaran->total)}}</td>
                  <td style="text-align: right;">
                    <a href="{{ route('edit.pengeluaran', $pengeluaran->id_pengeluaran)}}">
                      <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('delete.pengeluaran', $pengeluaran->id_pengeluaran)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button onclick="return confirm('Yakin ingin menghapus data?')" type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <div class="col-md-8">
                  <div class="col-md-6">
                    <form action="{{ route('search.totalpengeluaran') }}">
                      <div class="form-group">
                        <label>Cari Total Pengeluaran Bulanan:</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          @if(app('request')->input('tanggal') == NULL)
                          <input type="text" name="tanggal" value="<?php echo date('m/d/Y')?>" class="form-control pull-right" id="datepicker2">
                          @else
                          <input type="text" name="tanggal" value="{{app('request')->input('tanggal')}}" class="form-control pull-right" id="datepicker2">
                          @endif
                        </div>
                       <small style="color: red;">* Pilih Tahun dan Bulan. Untuk tanggal Bebas.</small>
                        <!-- /.input group -->
                      </div>
                  </div>
                  <div class="col-md-6">
                        <button class="btn btn-info mt" type="submit"><i class="fa fa-info"></i> Tampilkan Pengeluaran</button>
                  </div>
                </div>
                <div class="col-md-12">
                  <center>
                      @if(app('request')->input('tanggal') == NULL)
                        <p style="color: red;">Pilih Bulan Terlebih Dahulu! <br> Untuk Mengetahui Total Pengeluaran Bulanan</p>
                      @else
                      @foreach($totalBlnIni as $pengeluaranBulanan)
                      <div style="font-size: 15px;">
                        <table class="table table-hover table-striped">
                          <tr>
                            <th>Total Pendapatan Bulan {{$pengeluaranBulanan->bulan}}</th>
                            <th style="float: right; margin-right: 25px">{{number_format($pengeluaranBulanan->total)}} IDR</th>
                          </tr>
                        </table>
                      </div>
                      @endforeach
                      @endif
                    </form>
                    </center>
                </div>
              <ul class="pagination pagination-sm no-margin pull-right">
                <span></span>
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