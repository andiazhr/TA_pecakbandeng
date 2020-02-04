@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail Kegiatan Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <tr>
                  <th>No</th>
                  <th>Nama Kegiatan</th>
                  <th>Nama Produk</th>
                  <th>Diskon(%)</th>
                </tr>
                @foreach($data2 as $no => $produkKegiatan)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$produkKegiatan->Kegiatan->nama_kegiatan}}</td>
                  <td>{{$produkKegiatan->Produk->nama_produk}}</td>
                  <td>{{$produkKegiatan->discount}}</td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
              <a href="{{ url('kegiatan') }}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
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