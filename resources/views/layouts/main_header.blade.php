<!-- Logo -->
<a href="{{ url('dashboard')}}" class="logo" style="background-color: #00a65a">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset ('imageforuser/dashboard.svg') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Owner</b> Dashboard</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #00a65a">
      <!-- Sidebar toggle button--> 
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user-o"></i>
              <span class="label label-warning">
                <p hidden>{{$users = \App\Models\UsersPelanggan::where('status', '=', '1')->count()}}</p>
                {{$users}}  
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{$users}} login user</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <p hidden>{{$data = \App\Models\UsersPelanggan::where('status', '=', '1')->get()}}</p>
                  @foreach($data as $user)
                  <li>
                      <i class="fa fa-list-ul text-aqua" style="margin-left: 10px; margin-top: 10px; margin-right: 5px"></i> {{$user->username}}
                  </li>
                  @endforeach
                </ul>
              </li>
              @if($users != 0)
              <li class="header"></li>
              @endif
              <li class="footer"><a href="{{ url()->current() }}">Users login</a></li>
            </ul>
          </li>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">
                <p hidden>{{$tgl = Date("Y-m-d")}}{{$neworder = \App\Models\Order::where('created_at', 'like', "%{$tgl}%")->where('status', '0')->count('*')}}</p>
                {{$neworder}}  
              </span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{$neworder}} order</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <p hidden>{{$data = \App\Models\Order::where('created_at', 'like', "%{$tgl}%")->where('status', '0')->get()}}</p>
                  @foreach($data as $order)
                  <li>
                    <a href="{{ route('order.details', $order->id_order)}}">
                      <i class="fa fa-list-ul text-aqua"></i> {{$order->kode_order}}
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{ route('newOrder')}}">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('assetsadmin/dist/img/admin.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('assetsadmin/dist/img/admin.png') }}" class="img-circle" alt="User Image">

                <p>
                {{ Auth::user()->name }}
                  <small><i class="fa fa-calendar"></i> <?php echo date('d M Y') ?> | <i class="fa fa-clock-o"></i> <span id="jam"></span></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('profil', auth()->user()->id) }}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-danger btn-flat"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                        </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>

    </nav>