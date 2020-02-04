@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail Order Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <tr>
                  <th>No</th>
                  <th>Kode Pembelian</th>
                  <th>Nama Produk</th>
                  <th style="text-align: right">Jumlah Beli</th>
                  <th style="text-align: right">Harga Produk (Rp)</th>
                  <th style="text-align: center">Tanggal Pembelian</th>
                </tr>
                @foreach($detail as $no => $order)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$order->Order->kode_order}}</td>
                  <td>{{$order->Produk->nama_produk}}</td>
                  <td style="text-align: right">{{number_format($order->jumbel_produk)}}</td>
                  <td style="text-align: right">{{number_format($order->harga_produk)}}</td>
                  <td style="text-align: center">
                    <?php
                      echo substr($order->created_at, 0, 10);
                    ?>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="3">Ongkir</th>
                  <th style="text-align: right">-</th>
                  <th style="text-align: right">{{number_format($order->ongkir)}}</th>
                  <th style="text-align: center">-</th>
                </tr>
                @foreach($sum as $total)
                <tr>
                  <th colspan="3">Total</th>
                  <th style="text-align: right">{{number_format($total->jumbel_produk)}}</th>
                  <th style="text-align: right">{{number_format($order->ongkir + $total->harga_produk)}}</th>
                  <th style="text-align: center">-</th>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              <a href="{{ route('cetak_pdf', $order->id_order) }}"><button type="button" class="btn btn-info"><i class="fa fa-print"></i> Cetak </button></a>
              <a href="{{ url('order') }}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
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