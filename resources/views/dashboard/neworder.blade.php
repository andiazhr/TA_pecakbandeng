@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">New Order Table</h3>
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
            <table class="table table-hover table-striped table-bordered">
                <tr>
                  <th>No</th>
                  <th>Nama Pelanggan</th>
                  <th>Kode Pembelian</th>
                  <th style="text-align: center;">Status Pembelian</th>
                  <th style="text-align: right;">Total Pembelian</th>
                  <th style="text-align: center;">Tanggal Pembelian</th>
                  <th colspan="3" style="text-align: center;">Aksi</th>
                </tr>
                @foreach($data as $no => $order)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$order->Pelanggan->nama_pelanggan}}</td>
                  <td>{{$order->kode_order}}</td>
                  <td style="text-align: center;">
                    @if($order->status == 1)
                        <button type="submit" class="btn btn-xs btn-success">Lunas</button>
                      @else
                        <button type="submit" class="btn btn-xs btn-danger">Belum Lunas</button>
                    @endif
                  </td>
                  <td style="text-align: right;">{{number_format($order->total_order)}}</td>
                  <td style="text-align: center;">
                    <?php
                      echo substr($order->created_at, 0, 10);
                    ?>
                  </td>
                  <td>
                    @if($order->status == 1)
                        <button type="submit" class="btn btn-sm btn-success">Lunas</button>
                      @else
                      <form action="{{ route('status.order', $order->id_order)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="text" hidden name="kode_pembayaran" id="kode_pembayaran" value="{{$order->kode_order}}">
                        <input type="number" hidden name="status" id="status" value="1">
                        <button type="submit" class="btn btn-sm btn-danger">Ubah Status</button>
                      </form>
                    @endif
                  </td>
                  <td style="text-align: right;">
                    <a href="{{ route('order.details', $order->id_order)}}">
                      <button type="button" class="btn btn-sm btn-info"><i class="fa fa-info"></i></button>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('delete.order', $order->id_order)}}" method="post">
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
              <a href="{{ route('dashboard') }}" class="btn btn-default" style="float:right;">Back</a>
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