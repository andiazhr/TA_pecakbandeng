@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pendapatan Hari Ini Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <tr>
                  <th>No</th>
                  <th>Kode Pendapatan</th>
                  <th style="text-align: right; padding-right: 25px">Total Pendapatan</th>
                </tr>
                @foreach($data as $no => $pendpHarian)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$pendpHarian->kode_pendpPerHari}}</td>
                  <td style="text-align: right; padding-right: 25px">{{$pendpHarian->total_pendpPerHari}}</td>
                </tr>
                @endforeach
                @foreach($sum as $total)
                <tr>
                  <th colspan="2">Total</th>
                  <th style="text-align: right; padding-right: 25px">{{number_format($total->total_pendp)}}</th>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <a href="{{ route('dashboard') }}" class="btn btn-warning" style="float:right;">Back</a>
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