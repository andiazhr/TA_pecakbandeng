<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
<a class="navbar-brand" href="{{ url('/') }}">
    <img src="{{ asset ('imageforuser/warung.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt="">
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @if( auth('pelanggan')->check() )
        @if(Request::segment(2) == 'profile' || Request::segment(2) == 'editprofile')
        <li class="nav-item dropdown active">
          <a class="nav-link asparagus-sprouts font-18 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(auth('pelanggan')->user()->foto_profil == NULL)
          <i class="fa fa-user-circle fa-lg" style="margin-right: 3px"></i> {{ ucwords(auth('pelanggan')->user()->username) }}
          @else
          <img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="25px" height="25px"> {{ ucwords(auth('pelanggan')->user()->username) }}
          @endif
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if(auth('pelanggan')->user()->foto_profil == NULL)
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->username) }}"><i class="fas fa-user-circle fa-2x"></i> Profile</a>
            @else
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->username) }}"><img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="25px" height="25px"> Profile</a>
            @endif
            <a class="dropdown-item" href="{{ route('keluar')}}"><img src="{{ asset ('imageforuser/logout6.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Logout</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link asparagus-sprouts font-18 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(auth('pelanggan')->user()->foto_profil == NULL)
          <i class="fas fa-user-circle fa-lg" style="margin-right: 3px"></i> {{ ucwords(auth('pelanggan')->user()->username) }}
          @else
          <img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="25px" height="25px"> {{ ucwords(auth('pelanggan')->user()->username) }}
          @endif
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if(auth('pelanggan')->user()->foto_profil == NULL)
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->username) }}"><i class="fas fa-user-circle fa-2x"></i> Profile</a>
            @else
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->username) }}"><img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="25px" height="25px"> Profile</a>
            @endif
            <a class="dropdown-item" href="{{ route('keluar')}}"><img src="{{ asset ('imageforuser/logout6.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Logout</a>
        </li>
        @endif
      @else
        @if(Request::segment(2) == 'daftar' || Request::segment(2) == 'masuk')
        <li class="nav-item dropdown active">
          <a class="nav-link asparagus-sprouts font-18 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset ('imageforuser/click.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Disini
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('daftar') }}">Daftar</a>
            <a class="dropdown-item" href="{{ route('masuk') }}">Login</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link asparagus-sprouts font-18 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset ('imageforuser/click.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Disini
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('daftar') }}">Daftar</a>
            <a class="dropdown-item" href="{{ route('masuk') }}">Login</a>
        </li>
        @endif
      @endif
      @if(Request::segment(1) == '' && Request::segment(2) == '')
      <li class="nav-item active">
        <a class="nav-link asparagus-sprouts font-18" href="{{ url('/') }}"> <img src="{{ asset ('imageforuser/home.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Home </a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="{{ url('/') }}"> <img src="{{ asset ('imageforuser/home.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Home </a>
      </li>
      @endif
      @if(Request::segment(1) == 'menu')
      <li class="nav-item active">
        <a class="nav-link asparagus-sprouts font-18" href="{{ route('menu') }}"> <img src="{{ asset ('imageforuser/menu.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Menu</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="{{ route('menu') }}"> <img src="{{ asset ('imageforuser/menu.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Menu</a>
      </li>
      @endif
      @if(Request::segment(1) == 'keranjang')
      <li class="nav-item active">
        <a class="nav-link asparagus-sprouts font-18" href="{{ route('keranjang') }}"> <img src="{{ asset ('imageforuser/cart.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> <span class="badge badge-warning">{{ Session::has('keranjang') ? Session::get('keranjang')->totalJumbel : ''}}</span> Keranjang </a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="{{ route('keranjang') }}"> <img src="{{ asset ('imageforuser/cart.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> <span class="badge badge-warning">{{ Session::has('keranjang') ? Session::get('keranjang')->totalJumbel : ''}}</span> Keranjang </a>
      </li>
      @endif
      @if(Request::segment(1) != '')
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="{{url('/')}}#lokasi"> <img src="{{ asset ('imageforuser/location.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Lokasi</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="#lokasi"> <img src="{{ asset ('imageforuser/location.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Lokasi</a>
      </li>
      @endif
      @if(Request::segment(2) != '')
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="{{url('/')}}#about"> <img src="{{ asset ('imageforuser/info.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Tentang Kami</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link asparagus-sprouts font-18" href="#about"> <img src="{{ asset ('imageforuser/info.png') }}" width="25px" height="25px" class="d-inline-block align-top" alt=""> Tentang Kami</a>
      </li>
      @endif
    </ul>
    <form action="{{ route('search') }}" class="form-inline my-2 my-lg-0 d-none d-lg-block d-xl-none d-xl-block">
      <input type="mysearch" name="search" placeholder="Search" aria-label="Search" value="{{ app('request')->input('search') }}">
    </form>
    <form action="{{ route('search') }}" class="form-inline my-2 my-lg-0 d-none d-block d-sm-none d-sm-block d-md-none d-md-block d-lg-none">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ app('request')->input('search') }}">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
