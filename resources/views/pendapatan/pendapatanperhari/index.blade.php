@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pendapatan Harian Table</h3>
              @if(session()->get('success'))
                  <div class="col-12 d-flex justify-content-center">
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="text-align:center; font-size:16px; margin-top:10px;">
                          <div class="alert alert-default">
                              {{ session()->get('success') }} <img src="{{ asset ('/imageforuser/checked5.png') }}" alt="Jet" style="width:30px;height:30px;">
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
                  <th>Kode Pendapatan</th>
                  <th>Total Pendapatan</th>
                  <th>Tanggal Pembelian</th>
                  <th>Action</th>
                </tr>
                @foreach($data as $no => $pendpHarian)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$pendpHarian->kode_pendpperhari}}</td>
                  <td>{{$pendpHarian->total_pendpperhari}}</td>
                  <td>
                    <?php
                      echo substr($pendpHarian->created_at, 0, 10);
                    ?>
                  </td>
                  <td>
                    <form action="{{ route('delete.pendpPerHari', $pendpHarian->id_pendpperhari)}}" method="post">
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
                <div class="col-lg-8">
                  <div class="col-lg-6">
                    <form action="{{ route('search.pendpPerHari') }}">
                      <div class="form-group">
                        <label>Date:</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          @if(app('request')->input('tanggal') == NULL)
                          <input type="text" name="tanggal" value="<?php echo date('m/d/Y')?>" class="form-control pull-right" id="datepicker">
                          @else
                          <input type="text" name="tanggal" value="{{app('request')->input('tanggal')}}" class="form-control pull-right" id="datepicker">
                          @endif
                        </div>
                       <small style="color: red;">* Pilih Tahun dan Bulan. Untuk tanggal Bebas.</small>
                        <!-- /.input group -->
                      </div>
                  </div>
                  <div class="col-lg-6">
                        <button class="btn btn-info mt" type="submit"><i class="fa fa-info"></i> Tampilkan Pendapatan</button>
                  </div>
                </div>
                <div class="col-lg-12">
                  <center>
                      @if(app('request')->input('tanggal') == NULL)
                        <p style="color: red;">Pilih Bulan Terlebih Dahulu! <br> Untuk Mengetahui Total Pendapatan Bulanan</p>
                      @else
                      @foreach($totalBlnIni as $pendpBulanan)
                      <div id="pendpHarian" style="font-size: 15px;">
                        <table class="table table-hover table-striped">
                          <tr>
                            <th>Total Pendapatan Bulan {{$pendpBulanan->bulan}}</th>
                            <th style="float: right; margin-right: 25px">{{number_format($pendpBulanan->total_pendpBulanan)}} IDR</th>
                          </tr>
                        </table>
                       <small style="color: red;">* Masukkan pendapatan apabila periode bulan telah berakhir.</small>
                      </div>
                      @endforeach
                      @endif
                    </form>
                    @if(app('request')->input('tanggal') !=NULL)
                    <form role="form" method="post" action="{{ route('submit.pendpPerBulan') }}" enctype="multipart/form-data">
                    @csrf
                        @foreach($totalBlnIni as $pendpBulanan)
                        <input hidden type="text" name="bulan" value="{{app('request')->input('tanggal')}}">
                        <input hidden type="number" name="total_pendpBulanan" value="{{$pendpBulanan->total_pendpBulanan}}">
                        <button class="btn btn-success" type="submit" style="float: right;"><i class="fa fa-check"></i> Masukkan Pendapatan Bulan {{$pendpBulanan->bulan}}</button>
                        <a href="{{ url('Pendapatan/pendpPerHari') }}" class="btn btn-danger" style="float:right; margin-right: 7px"><i class="fa fa-times"></i> Cancel</a>
                        @endforeach
                      </form>
                    @endif
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