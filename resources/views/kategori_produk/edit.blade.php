@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kategori Produk Table</h3> 
              <form role="form" method="post" action="{{ route('update.kategoriProduk', $kategori->id_kategori) }}" enctype="multipart/form-data">
              <div class="box-body">
                @csrf
                @method('PUT')
                <div class="col-md-3">
                    <div class="form-group">
                      <label>Ubah Kategori Produk</label>
                      <input type="text" class="form-control" name="nama_kategori" placeholder="Masukkan Kategori Produk" value="{{$kategori->nama_kategori}}">
                    </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label class="mb-kategori">Untuk Tampilan</label><br>
                      <input type="radio" name="status" class="flat-red" value="1"<?=$kategori['status'] == '1' ? ' checked="checked"' : '';?>>
                      Ditampilkan
                      <input type="radio" name="status" class="flat-red" value="0"<?=$kategori['status'] == '0' ? ' checked="checked"' : '';?> style="margin-left: 20px">
                      Tidak Ditampilkan
                  </div>
                </div>
                
                <div class="col-md-4 mt-kategori" style="text-align: right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i> Ubah</button>
                    <a href="{{ url('kategoriProduk') }}"><button type="button" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Kembali</button></a>
                </div>
              </div>
              <div class="box-footer">
              </div>
            </form>

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
                  <th>Kategori Produk</th>
                </tr>
                @foreach($data as $no => $kategori)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$kategori->nama_kategori}}</td>
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