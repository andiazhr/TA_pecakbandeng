@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Pecak Bandeng 59</a></li>
        <li><a href="{{ url()->current() }}"> {{$profil->name}}</a></li>
        <li class="active"> Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('assetsadmin/dist/img/admin.png') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$profil->name}}</h3>

              <p class="text-muted text-center">Pengusaha</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Following</b> <a class="pull-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Friends</b> <a class="pull-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a href="#rating" data-toggle="tab">Activity Rating</a></li>
              <li><a href="#timelinerating" data-toggle="tab">Timeline Rating</a></li>
              <li><a href="#like" data-toggle="tab">Activity Like</a></li>
              <li><a href="#timelinelike" data-toggle="tab">Timeline Like</a></li>
              <li><a href="#review" data-toggle="tab">Activity Review</a></li>
              <li><a href="#timelinereview" data-toggle="tab">Timeline Review</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="rating">
                <!-- Post -->
                @foreach($rating as $star)
                <div class="post">
                  <div class="user-block">
                    @if($star->Pelanggan->foto_profil == NULL)
                        <img src="{{ asset('imageforuser/user3.png') }}" class="user-image" alt="User Image">
                    @else
                        <img class="img-circle img-bordered-sm" src="{{ asset('/imageforuser/pelanggan/'. $star->Pelanggan->foto_profil) }}" alt="user image">
                    @endif
                        <span class="username">
                          <strong class="text-blue">{{ucwords($star->Pelanggan->nama_pelanggan)}}</strong>
                          <i class="pull-right fa fa-star fa-lg" style="color: #f39c12"></i>
                        </span>
                    <span class="description">Memberikan <strong class="text-yellow">{{$star->nilai}}</strong> bintang pada produk <strong class="text-yellow">{{strtolower($star->Produk->nama_produk)}}</strong> - <?php echo date('h:i A', strtotime($star->created_at))?></span>
                  </div>
                  <!-- /.user-block -->
                </div>
                @endforeach
                @if($star->count() == 0)
                    <h3>Belum ada yang memberikan rating pada produk</h3>
                @endif
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="like">
                <!-- Post -->
                @foreach($like as $suka)
                <div class="post">
                  <div class="user-block">
                    @if($suka->Pelanggan->foto_profil == NULL)
                        <img src="{{ asset('imageforuser/user3.png') }}" class="user-image" alt="User Image">
                    @else
                        <img class="img-circle img-bordered-sm" src="{{ asset('/imageforuser/pelanggan/'. $suka->Pelanggan->foto_profil) }}" alt="user image">
                    @endif
                        <span class="username">
                          <strong class="text-blue">{{ucwords($suka->Pelanggan->nama_pelanggan)}}</strong>
                          <i class="pull-right fa fa-heart fa-lg" style="color: #dd4b39"></i>
                        </span>
                    <span class="description">Menyukai produk <strong class="text-red">{{strtolower($suka->Produk->nama_produk)}}</strong> - <?php echo date('h:i A', strtotime($suka->created_at))?></span>
                  </div>
                  <!-- /.user-block -->
                </div>
                @endforeach
                @if($like->count() == 0)
                    <h3>Belum ada yang menyukai produk</h3>
                @endif
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="review">
                <!-- Post -->
                @foreach($review as $ulasan)
                <div class="post">
                  <div class="user-block">
                    @if($ulasan->Pelanggan->foto_profil == NULL)
                        <img src="{{ asset('imageforuser/user3.png') }}" class="user-image" alt="User Image">
                    @else
                        <img class="img-circle img-bordered-sm" src="{{ asset('/imageforuser/pelanggan/'. $ulasan->Pelanggan->foto_profil) }}" alt="user image">
                    @endif
                        <span class="username">
                          <strong class="text-blue">{{ucwords($ulasan->Pelanggan->nama_pelanggan)}}</strong>
                          <i class="pull-right fa fa-comment fa-lg" style="color: #444"></i>
                        </span>
                    <span class="description">Mengomentari produk <strong class="text-black">{{strtolower($ulasan->Produk->nama_produk)}}</strong> - <?php echo date('h:i A', strtotime($ulasan->created_at))?></span>
                  </div>
                  <!-- /.user-block -->
                  <p>{{$ulasan->review}}</p>
                  <div class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        @if($ulasan->status == 0)
                            <input disabled class="form-control input-sm" placeholder="Response" value="Belum dipublikasi, butuh izin">
                        @else
                            <input disabled class="form-control input-sm" placeholder="Response" value="Sudah dipublikasi, mendapat izin">
                        @endif
                        </div>
                      <div class="col-sm-3">
                        @if($ulasan->status == 0)
                        <form action="{{ route('review.status', $ulasan->id_review)}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="number" hidden name="status" value="1">
                            <button type="submit" class="btn btn-primary pull-right btn-block btn-sm">Publikasi</button>
                        </form>
                        @else
                        <form action="{{ route('review.status', $ulasan->id_review)}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="number" hidden name="status" value="0">
                            <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Batal publikasi</button>
                        </form>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @if($review->count() == 0)
                    <h3>Belum ada ulasan tentang produk</h3>
                @endif
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timelinerating">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  @foreach($groupdaterating as $daterating)
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-yellow">
                            {{$daterating->tanggal}}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-star bg-yellow"></i>

                    <div class="timeline-item">
                    @foreach($grouprating as $rate)
                        @if($daterating->tanggal == $rate->tanggal)
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('h:i A', strtotime($rate->created_at))?></span>
                            <h3 class="timeline-header"><strong class="text-blue">{{ucwords($rate->nama_pelanggan)}}</strong> memberikan rating untuk produk <strong class="text-yellow">{{strtolower($rate->nama_produk)}}</strong></h3>
                            <div class="timeline-body">
                                @if($rate->nilai == 1)
                                    {{$rate->nilai}}
                                    <i class="fa fa-star text-yellow"></i>
                                @elseif($rate->nilai == 2)
                                    {{$rate->nilai}}
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                @elseif($rate->nilai == 3)
                                    {{$rate->nilai}}
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                @elseif($rate->nilai == 4)
                                    {{$rate->nilai}}
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                @else
                                    {{$rate->nilai}}
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                    <i class="fa fa-star text-yellow"></i>
                                @endif
                            </div>
                        @endif
                    @endforeach
                    </div>
                  </li>
                  <!-- END timeline item -->
                  @endforeach

                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
              <div class="tab-pane" id="timelinelike">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline item -->
                  @foreach($groupdatelike as $datelike)
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                            {{$datelike->tanggal}}
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-heart bg-red"></i>

                    @foreach($grouplike as $like)
                    @if($datelike->tanggal == $like->tanggal)
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('h:i A', strtotime($like->created_at))?></span>

                      <h3 class="timeline-header no-border"><strong class="text-blue">{{ucwords($like->nama_pelanggan)}}</strong> menyukai produk <strong class="text-red">{{strtolower($like->nama_produk)}}</strong>
                      </h3>
                    </div>
                    @endif
                    @endforeach
                  </li>
                  <!-- END timeline item -->
                  @endforeach

                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
              <div class="tab-pane" id="timelinereview">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline item -->
                  @foreach($groupdatereview as $datereview)
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-black">
                            {{$datereview->tanggal}}
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-comment bg-black"></i>

                    @foreach($groupreview as $ulas)
                    @if($datereview->tanggal == $ulas->tanggal)
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('h:i A', strtotime($ulas->created_at))?></span>

                      <h3 class="timeline-header"><strong class="text-blue">{{ucwords($ulas->nama_pelanggan)}}</strong> mengomentari produk <strong class="text-black">{{strtolower($ulas->nama_produk)}}</strong></h3>

                      <div class="timeline-body">
                        {{$ulas->review}}
                      </div>
                    </div>
                    @endif
                    @endforeach
                  </li>
                  <!-- END timeline item -->
                  @endforeach

                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection