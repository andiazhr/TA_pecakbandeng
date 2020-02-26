@extends('Layouts.master')
@section('content')
<!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pelanggan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-striped">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Nomor Handphone</th>
                  <th>Username</th>
                </tr>
                @foreach($data as $no => $user)
                <tr>
                  <td>{{$no +1}}</td>
                  <td>{{$user->nama_pelanggan}}</td>
                  <td>{{$user->email_pelanggan}}</td>
                  <td>{{$user->phone_number}}</td>
                  <td>{{$user->username}}</td>
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