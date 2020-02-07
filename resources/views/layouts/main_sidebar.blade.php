<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assetsadmin/dist/img/admin.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        @if(Request::segment(1) == 'home')
        <li class="active">
          <a href="{{ url('home')}}">
            <i class="fa fa-bar-chart"></i> <span>Dashboard</span>
          </a>
        </li>
        @else
        <li>
          <a href="{{ url('home')}}">
            <i class="fa fa-bar-chart"></i> <span>Dashboard</span>
          </a>
        </li>
        @endif

        @if(Request::segment(1) == 'kategoriproduk')
        <li class="active">
          <a href="{{ url('kategoriProduk')}}">
            <i class="fa fa-table"></i> <span>Kategori Produk</span>
          </a>
        </li>
        @else
        <li>
          <a href="{{ url('kategoriProduk')}}">
            <i class="fa fa-table"></i> <span>Kategori Produk</span>
          </a>
        </li>
        @endif

        @if(Request::segment(1) == 'Stok')
        <li class="active">
          <a href="{{ url('Stok')}}">
            <i class="fas fa-box" style="margin-right: 7px"></i> <span>Stok</span>
          </a>
        </li>
        @else
        <li>
          <a href="{{ url('Stok')}}">
            <i class="fas fa-box" style="margin-right: 7px"></i> <span>Stok</span>
          </a>
        </li>
        @endif
        
        @if(Request::segment(1) == 'produk')
        <li class="active">
          <a href="{{ url('produk')}}">
            <i class="fas fa-drumstick-bite" style="margin-right: 7px"></i> <span>Produk</span>
          </a>
        </li>
        @else
        <li>
          <a href="{{ url('produk')}}">
            <i class="fas fa-drumstick-bite" style="margin-right: 7px"></i> <span>Produk</span>
          </a>
        </li>
        @endif
        
        @if(Request::segment(1) == 'kegiatan')
        <li class="active">
          <a href="{{ url('kegiatan')}}">
            <i class="fas fa-calendar-day" style="margin-right: 7px"></i> <span>Kegiatan</span>
          </a>
        </li>
        @else
        <li>
          <a href="{{ url('kegiatan')}}">
            <i class="fas fa-calendar-day" style="margin-right: 7px"></i> <span>Kegiatan</span>
          </a>
        </li>
        @endif

        @if(Request::segment(1) == 'order')
        <li class="active">
          <a href="{{ url('order')}}">
            <i class="fa fa-list-ul"></i> <span>Order</span>
          </a>
        </li>
        @else
        <li>
          <a href="{{ url('order')}}">
            <i class="fa fa-list-ul"></i> <span>Order</span>
          </a>
        </li>
        @endif

        @if(Request::segment(2) == 'pendpPerHari')
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-book"></i> <span>Pendapatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('Pendapatan/pendpPerHari') }}"><i class="fa fa-book"></i> Pendapatan Harian</a></li>
            <li><a href="{{ url('Pendapatan/pendpPerBulan') }}"><i class="fa fa-book"></i> Pendapatan Bulanan</a></li>
            <li><a href="{{ url('Pendapatan/pendpPerTahun') }}"><i class="fa fa-book"></i> Pendapatan Tahunan</a></li>
          </ul>
        </li>
        @elseif(Request::segment(2) == 'pendpPerBulan')
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-book"></i> <span>Pendapatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('Pendapatan/pendpPerHari') }}"><i class="fa fa-book"></i> Pendapatan Harian</a></li>
            <li class="active"><a href="{{ url('Pendapatan/pendpPerBulan') }}"><i class="fa fa-book"></i> Pendapatan Bulanan</a></li>
            <li><a href="{{ url('Pendapatan/pendpPerTahun') }}"><i class="fa fa-book"></i> Pendapatan Tahunan</a></li>
          </ul>
        </li>
        @elseif(Request::segment(2) == 'pendpPerTahun')
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-book"></i> <span>Pendapatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('Pendapatan/pendpPerHari') }}"><i class="fa fa-book"></i> Pendapatan Harian</a></li>
            <li><a href="{{ url('Pendapatan/pendpPerBulan') }}"><i class="fa fa-book"></i> Pendapatan Bulanan</a></li>
            <li class="active"><a href="{{ url('Pendapatan/pendpPerTahun') }}"><i class="fa fa-book"></i> Pendapatan Tahunan</a></li>
          </ul>
        </li>
        @else
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Pendapatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('Pendapatan/pendpPerHari') }}"><i class="fa fa-book"></i> Pendapatan Harian</a></li>
            <li><a href="{{ url('Pendapatan/pendpPerBulan') }}"><i class="fa fa-book"></i> Pendapatan Bulanan</a></li>
            <li><a href="{{ url('Pendapatan/pendpPerTahun') }}"><i class="fa fa-book"></i> Pendapatan Tahunan</a></li>
          </ul>
        </li>
        @endif
        
    </section>
    <!-- /.sidebar -->