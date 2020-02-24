@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Laba Bersih Table</h3> 
              <div class="box-body">
                <div class="col-md-8">
                  <div class="col-md-6">
                    <form action="{{ route('search.totallabaBersih') }}">
                      <div class="form-group">
                        <label>Hitung Laba Bersih Bulanan:</label>

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
                        <button class="btn btn-info mt" type="submit"><i class="fa fa-info"></i> Tampilkan Laba Bersih</button>
                  </div>
                </div>
                <div class="col-md-12">
                  <center>
                      @if(app('request')->input('tanggal') == NULL)
                        <p style="color: red;">Pilih Bulan Terlebih Dahulu! <br> Untuk Mengetahui Total Laba Bersih Bulanan</p>
                      @else
                      @foreach($totalPendp as $total_Pendp)
                      <div style="font-size: 15px;">
                        <table class="table">
                          <tr>
                            <th>Total Pendapatan Bulan {{$total_Pendp->bulan}}</th>
                            <th style="float: right; margin-right: 25px">{{number_format($total_Pendp->total)}} IDR</th>
                          </tr>
                      @endforeach
                      @foreach($totalPengeluaran as $total_pengeluaran)
                          <tr>
                            <th>Total Pengeluaran Bulan {{$total_pengeluaran->bulan}}</th>
                            <th style="float: right; margin-right: 25px">{{number_format($total_pengeluaran->total)}} IDR</th>
                          </tr>
                      @endforeach
                          <tr>
                            <th>Total Laba Bersih Bulan {{$total_pengeluaran->bulan}}</th>
                            <th style="float: right; margin-right: 25px">{{number_format($total_Pendp->total-$total_pengeluaran->total)}} IDR</th>
                          </tr>
                        </table>
                      </div>
                       <small style="color: red;">* Masukkan laba bersih apabila periode bulan telah berakhir.</small>
                      @endif
                    </form>
                    @if(app('request')->input('tanggal') !=NULL)
                      <form role="form" method="post" action="{{ route('submit.labaBersih') }}" enctype="multipart/form-data">
                    @csrf
                        @foreach($totalPendp as $total_Pendp)
                        <input hidden type="text" name="tanggal" value="{{app('request')->input('tanggal')}}">
                        <input hidden type="number" name="total" value="{{$total_Pendp->total-$total_pengeluaran->total}}">
                        <button class="btn btn-success" type="submit" style="float: right; margin-top: 15px"><i class="fa fa-check"></i> Masukkan Laba Bersih Bulan {{$total_Pendp->bulan}}</button>
                        <a href="{{ url('pengeluaran') }}" class="btn btn-danger" style="float:right; margin-right: 7px; margin-top: 15px"><i class="fa fa-times"></i> Cancel</a>
                        @endforeach
                      </form>
                    @endif
                    </center>
                </div>
              </div>
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
                  <th>Bulan</th>
                  <th style="text-align: right; padding-right: 25px">Total Laba Bersih(IDR)</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
                @foreach($data as $no => $lababersih)
                <tr>
                  <td>{{$no +1}}</td>
                  <td><?php echo date('F Y', strtotime($lababersih->tanggal))?></td>
                  <td style="text-align: right; padding-right: 25px">{{number_format($lababersih->total)}}</td>
                  <td style="text-align: center;">
                    <form action="{{ route('delete.labaBersih', $lababersih->id_laba)}}" method="post">
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