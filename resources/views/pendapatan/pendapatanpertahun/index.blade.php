@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pendapatan Tahunan Table</h3>
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
                  <th>Tahun Pendapatan</th>
                  <th>Total Pendapatan</th>
                  <th>Action</th>
                </tr>
                @foreach($data as $no => $pendpTahunan)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$pendpTahunan->tahun}}</td>
                  <td>{{$pendpTahunan->total_pendppertahun}}</td>
                  <td>
                    <form action="{{ route('delete.pendpPerTahun', $pendpTahunan->id_pendppertahun)}}" method="post">
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