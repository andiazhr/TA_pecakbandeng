<nav class="navbar navbar-expand-lg navbar-dark bg-success" id="navbar">
<a class="navbar-brand" href="{{ url('itsfood') }}">
    <img src="{{ asset ('imageforuser/warung.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt="">
</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @if( auth('pelanggan')->check() )
        @if(Request::segment(2) == 'profile' || Request::segment(2) == 'editprofile')
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(auth('pelanggan')->user()->foto_profil == NULL)
          <i class="fas fa-image fa-lg" style="margin-right: 3px"></i> {{ auth('pelanggan')->user()->username }}
          @else
          <img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="30px" height="30px"> {{ auth('pelanggan')->user()->username }}
          @endif
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if(auth('pelanggan')->user()->foto_profil == NULL)
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->id_pelanggan) }}"><i class="fas fa-image fa-2x"></i> Profil</a>
            @else
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->id_pelanggan) }}"><img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="30px" height="30px"> Profil</a>
            @endif
            <a class="dropdown-item" href="{{ route('keluar')}}"><img src="{{ asset ('imageforuser/logout6.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Logout</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(auth('pelanggan')->user()->foto_profil == NULL)
          <i class="fas fa-image fa-lg" style="margin-right: 3px"></i> {{ auth('pelanggan')->user()->username }}
          @else
          <img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="30px" height="30px"> {{ auth('pelanggan')->user()->username }}
          @endif
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @if(auth('pelanggan')->user()->foto_profil == NULL)
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->id_pelanggan) }}"><i class="fas fa-image fa-2x"></i> Profil</a>
            @else
            <a class="dropdown-item" href="{{ route('profile', auth('pelanggan')->user()->id_pelanggan) }}"><img class="profil mb-1" src="{{ asset('/imageforuser/pelanggan/'. auth('pelanggan')->user()->foto_profil) }}" alt="" width="30px" height="30px"> Profil</a>
            @endif
            <a class="dropdown-item" href="{{ route('keluar')}}"><img src="{{ asset ('imageforuser/logout6.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Logout</a>
        </li>
        @endif
      @else
        @if(Request::segment(2) == 'daftar' || Request::segment(2) == 'masuk')
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset ('imageforuser/click.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Disini
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('daftar') }}">Daftar</a>
            <a class="dropdown-item" href="{{ route('masuk') }}">Login</a>
        </li>
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="{{ asset ('imageforuser/click.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Disini
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('daftar') }}">Daftar</a>
            <a class="dropdown-item" href="{{ route('masuk') }}">Login</a>
        </li>
        @endif
      @endif
      @if(Request::segment(1) == 'itsfood' && Request::segment(2) == '')
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('itsfood') }}"> <img src="{{ asset ('imageforuser/home.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Home </a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ url('itsfood') }}"> <img src="{{ asset ('imageforuser/home.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Home </a>
      </li>
      @endif
      @if(Request::segment(2) == 'menu')
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('menu') }}"> <img src="{{ asset ('imageforuser/menu.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Menu</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('menu') }}"> <img src="{{ asset ('imageforuser/menu.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Menu</a>
      </li>
      @endif
      @if(Request::segment(2) == 'keranjang')
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('keranjang') }}"> <img src="{{ asset ('imageforuser/cart.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> <span class="badge badge-warning">{{ Session::has('keranjang') ? Session::get('keranjang')->totalJumbel : ''}}</span> Keranjang </a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('keranjang') }}"> <img src="{{ asset ('imageforuser/cart.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> <span class="badge badge-warning">{{ Session::has('keranjang') ? Session::get('keranjang')->totalJumbel : ''}}</span> Keranjang </a>
      </li>
      @endif
      @if(Request::segment(2) != 'itsfood')
      <li class="nav-item">
        <a class="nav-link" href="{{url('itsfood')}}#lokasi"> <img src="{{ asset ('imageforuser/location.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Lokasi</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="#lokasi"> <img src="{{ asset ('imageforuser/location.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Lokasi</a>
      </li>
      @endif
      @if(Request::segment(2) != 'itsfood')
      <li class="nav-item">
        <a class="nav-link" href="{{url('itsfood')}}#about"> <img src="{{ asset ('imageforuser/info.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Tentang Kami</a>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="#about"> <img src="{{ asset ('imageforuser/info.png') }}" width="30px" height="30px" class="d-inline-block align-top" alt=""> Tentang Kami</a>
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
