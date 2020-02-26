<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="{{ asset ('imageforuser/dashboard.svg') }}" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Owner | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />
  <!-- Bootstrap 3.3.7 -->
  <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css" />
  <!-- <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.css') }}"> -->

  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/plugins/iCheck/all.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assetsadmin/bower_components/select2/dist/css/select2.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assetsadmin/plugins/iCheck/flat/blue.css') }}">
  
  <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
  
  <script src="{{ asset('js/jquery-latest.min.js') }}"></script>
  <!-- <script src="{{ asset('js/custom.js') }}"></script> -->
  


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
        #loader{
          visibility:hidden;
          }
         * 
          {
          box-sizing:border-box;
          }
          /* .main-sidebar { background-color: #f9fafc !important }. */
          .mt{
            margin-top: 25px;
          }
          .btn-kegiatan{
            margin-top: 6px;
          }
          .mt-kategori{
            margin-top: 25px;
          }
          .mt-kategori-edit{
            margin-top: 25px;
          }
          .mt-stok{
            margin-top: 25px;
          }
          .mt-stok-edit{
            margin-top: 25px;
          }
          .mt-produk{
            margin-top: 24px;
          }
          .mt-produk-edit{
            margin-top: 21px;
          }
          .mb-kategori{
            margin-bottom: 10px;
          }
          [class*="kolom"]
          {
          float :left;
          }
          @media only screen and (min-width:480px) and (max-width:800px)
          {
          .mt{
            margin-top: 0;
            margin-bottom: 20px;
          }
          .btn-kegiatan{
            margin-top: 0;
          }
          .mt-kategori{
            margin-top: 0;
          }
          .mt-kategori-edit{
            margin-top: 0;
          }
          .mt-stok{
            margin-top: 0;
          }
          .mt-stok-edit{
            margin-top: 0;
          }
          .mt-produk{
            margin-top: 0;
          }
          .mt-produk-edit{
            margin-top: 0;
          }
          .mb-kategori{
            margin-bottom: 0;
          }
          }
          @media only screen and (max-width:480px)
          {
          .mt{
            margin-top: 0;
            margin-bottom: 20px;
          }
          .btn-kegiatan{
            margin-top: 0;
          }
          .mt-kategori{
            margin-top: 0;
          }
          .mt-kategori-edit{
            margin-top: 0;
          }
          .mt-stok{
            margin-top: 0;
          }
          .mt-stok-edit{
            margin-top: 0;
          }
          .mt-produk{
            margin-top: 0;
          }
          .mt-produk-edit{
            margin-top: 0;
          }
          .mb-kategori{
            margin-bottom: 0;
          }
          }

          .nopadding {
            padding: 0 !important;
            margin: 0 !important;
          }
        </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    @include('Layouts.main_header')
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar sidebar-light-primary">
    @include('Layouts.main_sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    @include('Layouts.main_footer')
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    @include('Layouts.control_sidebar')
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- jQuery UI 1.11.4 -->
<!-- <script src="{{ asset('assetsadmin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- <script>
  $.widget.bridge('uibutton', $.ui.button);
</script> -->
<script src="{{ asset('assetsadmin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assetsadmin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('assetsadmin/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assetsadmin/bower_components/morris.js/morris.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assetsadmin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assetsadmin/dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assetsadmin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap  -->
<script src="{{ asset('assetsadmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assetsadmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('assetsadmin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assetsadmin/bower_components/chart.js/Chart.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assetsadmin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- datepicker -->
<!-- <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('assetsadmin/dist/js/pages/dashboard2.js') }}"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assetsadmin/dist/js/demo.js') }}"></script>

<!-- jQuery 3 -->
<!-- Select2 -->
<script src="{{ asset('assetsadmin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('assetsadmin/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('assetsadmin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('assetsadmin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('assetsadmin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assetsadmin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assetsadmin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('assetsadmin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('assetsadmin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset('assetsadmin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Page script -->
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })

    $( document ).ready(function() {
        $("#year").datepicker({ 
            format: 'yyyy',
            autoclose: true
        });
    });

    $( document ).ready(function() {
        $("#from-datepicker").datepicker({ 
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    $( document ).ready(function() {
        $("#from-datepicker2").datepicker({ 
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    $( document ).ready(function() {
        $("#from-datepicker3").datepicker({ 
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<script>$('div.alert').delay(3000).slideUp(300);</script>

<!-- <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.js') }}">
<script>
$('#btnAlert').click(function(e){
  swal({
    title : 'Yakin ingin dihapus?',
    text: 'This is message',
    type : 'warning',
    confirmButtonText: 'Cool'
  })
});
</script> 

<script type="text/javascript">
  
$('.test').click(function () {
  var postId = $(this).data('id');
      swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: 'btn-danger waves-effect waves-light',
      confirmButtonText: "Delete",
      cancelButtonText: "Cancel",
      closeOnConfirm: true,
      closeOnCancel: true
      },
      function(){
        window.location.href = "itsfood.delete" + postId;
      });
    });
  
</script>-->

<script>
  function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      // add a zero in front of numbers<10
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('jam').innerHTML = h + ":" + m + ":" + s;
      t = setTimeout(function() {
        startTime()
      }, 500);
    }
    startTime();
</script>

<script>
function mySelectKategori() {
  var x = document.getElementById("kategori").value;
  var kategori = x.split("|");
  var pecah = kategori[1];
  if (pecah === 'Makanan'){ 
  document.getElementById("id_stok").disabled = false;
  }
  else{
  document.getElementById("id_stok").disabled = true;
  }
}
</script>

<!-- chart -->
@if(Request::Segment(1) == 'dashboard')
<script src="{{ asset('js/Chart.js') }}"></script>
<script>
  function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
</script>
<script>
var urlMakanan = "{{url('/dashboard/byProdukterjualMakanan')}}";
var Makanan = new Array();
var Jumbel = new Array();
$(document).ready(function(){
  $.get(urlMakanan, function(response){
    response.forEach(function(data){
        Makanan.push(data.nama_produk);
        Jumbel.push(data.jumbel_produk);
    });
    var ctx = document.getElementById('Makanan').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: Makanan,
              datasets: [{
                  label: 'Jumlah Beli',
                  data: Jumbel,
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>

<script>
var urlMinuman = "{{url('/dashboard/byProdukterjualMinuman')}}";
var Minuman = new Array();
var JumbelMinum = new Array();
$(document).ready(function(){
  $.get(urlMinuman, function(response){
    response.forEach(function(data){
      Minuman.push(data.nama_produk);
      JumbelMinum.push(data.jumbel_produk);
    });
    var ctx = document.getElementById('Minuman').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: Minuman,
              datasets: [{
                  label: 'Jumlah Beli',
                  data: JumbelMinum,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
  	              borderColor: 'rgba(255, 99, 132, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>
<!-- pendapatan harian -->
<script>
var urlPendpHarian = "{{url('/dashboard/byPendpHarian')}}";
var PendpHarian = new Array();
var TglPendpHarian = new Array();
$(document).ready(function(){
  $.get(urlPendpHarian, function(response){
    response.forEach(function(data){
      PendpHarian.push(data.pendpHarian);
      TglPendpHarian.push(data.tglpendpHarian);
    });
    var ctx = document.getElementById('Pendp_Harian').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: TglPendpHarian,
              datasets: [{
                  label: 'Pendapatan Harian',
                  data: PendpHarian,
                  backgroundColor: 'rgba(51, 102, 255, 0.2)',
  	              borderColor: 'rgba(51, 102, 255, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>
<!-- pendapatan bulanan -->
<script>
var urlPendpBulanan = "{{url('/dashboard/byPendpBulanan')}}";
var PendpBulanan = new Array();
var BulanPendp = new Array();
$(document).ready(function(){
  $.get(urlPendpBulanan, function(response){
    response.forEach(function(data){
      PendpBulanan.push(data.pendpBulanan);
      BulanPendp.push(data.bulanPendp);
    });
    var ctx = document.getElementById('Pendp_Bulanan').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: BulanPendp,
              datasets: [{
                  label: 'Pendapatan Bulanan',
                  data: PendpBulanan,
                  backgroundColor: 'rgba(46, 204, 113, 0.2)',
  	              borderColor: 'rgba(46, 204, 113, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>
<!-- pendapatan tahunan -->
<script>
var urlPendpTahunan = "{{url('/dashboard/byPendpTahunan')}}";
var PendpTahunan = new Array();
var TahunPendp = new Array();
$(document).ready(function(){
  $.get(urlPendpTahunan, function(response){
    response.forEach(function(data){
      PendpTahunan.push(data.pendpTahunan);
      TahunPendp.push(data.tahun);
    });
    var ctx = document.getElementById('Pendp_Tahunan').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: TahunPendp,
              datasets: [{
                  label: 'Pendapatan Tahunan',
                  data: PendpTahunan,
                  backgroundColor: 'rgba(0, 204, 255, 0.2)',
  	              borderColor: 'rgba(0, 204, 255, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>
<!-- Pengeluaran -->
<script>
var urlPengeluaran = "{{url('/dashboard/Pengeluaran')}}";
var Pengeluaran = new Array();
var BulanPengeluaran = new Array();
$(document).ready(function(){
  $.get(urlPengeluaran, function(response){
    response.forEach(function(data){
      Pengeluaran.push(data.Pengeluaran);
      BulanPengeluaran.push(data.bulan);
    });
    var ctx = document.getElementById('Pengeluaran').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: BulanPengeluaran,
              datasets: [{
                  label: 'Pengeluaran Bulanan',
                  data: Pengeluaran,
                  backgroundColor: 'rgba(255, 204, 0, 0.2)',
  	              borderColor: 'rgba(255, 204, 0, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>
<!-- Laba Bersih -->
<script>
var urlLabaBersih = "{{url('/dashboard/LabaBersih')}}";
var LabaBersih = new Array();
var BulanLabaBersih = new Array();
$(document).ready(function(){
  $.get(urlLabaBersih, function(response){
    response.forEach(function(data){
      LabaBersih.push(data.LabaBersih);
      BulanLabaBersih.push(data.bulan);
    });
    var ctx = document.getElementById('Laba_Bersih').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: BulanLabaBersih,
              datasets: [{
                  label: 'Laba Bersih Bulanan',
                  data: LabaBersih,
                  backgroundColor: 'rgba(51, 102, 255, 0.2)',
  	              borderColor: 'rgba(51, 102, 255, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
  });
});
</script>
@endif
<!-- end chart -->
<script>
function my30pendpHarian() {
  var x = document.getElementById("pendpHarian");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>

<script>
        $('#myTab a').click(function(e) {
          var scrollHeight = $(document).scrollTop();

          $(this).tab('show');

          // setTimeout(function() {
              $(window).scrollTop(scrollHeight );
          // }, 5);
        });

        // store the currently selected tab in the hash value
        $("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');
    </script>
</body>
</html>
