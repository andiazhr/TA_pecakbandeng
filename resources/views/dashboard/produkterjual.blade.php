@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Produk Terjual Table</h3>
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
                  <th>Nama Produk</th>
                  <th style="text-align: right; padding-right: 25px">Jumlah Beli</th>
                </tr>
                @foreach($data as $no => $produkterjual)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$produkterjual->nama_produk}}</td>
                  <td style="text-align: right; padding-right: 25px">{{$produkterjual->jumbel_produk}}</td>
                </tr>
                @endforeach
                @foreach($sum as $total)
                <tr>
                  <th colspan="2">Total</th>
                  <th style="text-align: right; padding-right: 25px">{{number_format($total->jumbel_produk)}}</th>
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