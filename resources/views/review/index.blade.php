@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Review Table</h3> 
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
                  <th>Nama Pelanggan</th>
                  <th>Nama Produk</th>
                  <th>Isi Review</th>
                  <th style="text-align: center;">Status</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
                @foreach($data as $no => $review)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$review->Pelanggan->nama_pelanggan}}</td>
                  <td>{{$review->Produk->nama_produk}}</td>
                  <td>{{$review->review}}</td>
                  <td style="text-align: center;">
                    @if($review->status == 1)
                        <button type="submit" class="btn btn-xs btn-success">Ditampilkan</button>
                      @else
                        <button type="submit" class="btn btn-xs btn-danger">Tidak Ditampilkan</button>
                    @endif
                  </td>
                  <td style="text-align: center;">
                    @if($review->status == 1)
                      <form action="{{ route('review.status', $review->id_review)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="0">
                        <button type="submit" class="btn btn-sm btn-primary">Ubah Status</button>
                      </form>
                      @else
                      <form action="{{ route('review.status', $review->id_review)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="number" hidden name="status" id="status" value="1">
                        <button type="submit" class="btn btn-sm btn-danger">Ubah Status</button>
                      </form>
                    @endif
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