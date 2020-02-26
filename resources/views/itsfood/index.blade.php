<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{ asset ('imageforuser/warung.png') }}" />
    @if(Request::segment(1) == 'menu')
    <title>Menu</title>
    @elseif(Request::segment(1) == 'keranjang')
    <title>Keranjang</title>
    @elseif(Request::segment(1) == 'checkout')
    <title>Checkout</title>
    @elseif(Request::segment(1) == 'masuk')
    <title>Login</title>
    @elseif(Request::segment(1) == 'daftar')
    <title>Daftar</title>
    @elseif(Request::segment(1) == 'profile')
    <title>Profile</title>
    @else
    <title>Pecak Bandeng 59</title>
    @endif
    <link href="{{ asset('css/itsfood.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <!-- <script src="{{ asset('js/checkout.js') }}"></script> -->
</head>
<body>
<div class="kolom12">
  <header class="sticky-top">
    @include('itsfood.header')
  </header>
  <div class="">
    @yield('content')
  </div>
  <footer class="">
    @include('itsfood.footer')
  </footer>
  
	<button class="scroll_To_Top"><span><i class="fas fa-caret-up fa-3x"></i><!-- Image goes here. --></span></button>
	<div class="se-pre-con"></div>
</div>
<script>$('div.alert').delay(5000).slideUp(300);</script>
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/video.js') }}"></script> -->

<script>
$(document).on("click", ".review", function () {
     var Id_Review = $(this).data('reviewid');
     var Id = $(this).data('id');
     var Id_Produk = $(this).data('idproduk');
     var Nama_Produk = $(this).data('namaproduk');
     $(".modal-body #id_review").val( Id_Review );
     $(".modal-body #id_pelanggan").val( Id );
     $(".modal-body #id_produk").val( Id_Produk );
     $(".modal-body #nama_produk").text( Nama_Produk );
});
</script>

<script>
$(document).on("click", ".reviewedit", function () {
     var Id_Review = $(this).data('idreview');
     var Id = $(this).data('id');
     var Id_Produk = $(this).data('idproduk');
     var Nama_Produk = $(this).data('namaproduk');
     var Review = $(this).data('review');
     $(".modal-body #id_review_edit").val( Id_Review );
     $(".modal-footer #id_review_delete").val( Id_Review );
     $(".modal-body #id_pelanggan_edit").val( Id );
     $(".modal-body #id_produk_edit").val( Id_Produk );
     $(".modal-body #nama_produk_edit").text( Nama_Produk );
     $(".modal-body #review_edit").val( Review );
});
</script>

<script>
$(document).on("click", ".rating", function () {
     var Id = $(this).data('id');
     var IdRating = $(this).data('idrating');
     var Id_Produk = $(this).data('idproduk');
     var Nama_Produk = $(this).data('namaproduk');
     var nilai = $(this).data('nilai');
     $(".modal-body #id_pelanggan").val( Id );
     $(".modal-body #id_rating").val( IdRating );
     $(".modal-body #id_produk").val( Id_Produk );
     $(".modal-header #nama_produk").text( Nama_Produk );
     $(".modal-footer #id_rating").val( IdRating );
});
</script>

<script>
$(document).on("click", ".ratingnew", function () {
     var StarId = $(this).data('starid');
     var Id = $(this).data('id');
     var Id_Produk = $(this).data('idproduk');
     var Nama_Produk = $(this).data('namaproduk');
     $(".modal-body #id_rating").val( StarId );
     $(".modal-body #id_pelanggan").val( Id );
     $(".modal-body #id_produk").val( Id_Produk );
     $(".modal-header #nama_produk").text( Nama_Produk );
});
</script>

<script>
$(document).ready(function(){
  // Activate Carousel
  $("#myCarousel").carousel();
    
  // Enable Carousel Indicators
  $(".item1").click(function(){
    $("#myCarousel").carousel(0);
  });
  $(".item2").click(function(){
    $("#myCarousel").carousel(1);
  });
  $(".item3").click(function(){
    $("#myCarousel").carousel(2);
  });
    
  // Enable Carousel Controls
  $(".carousel-control-prev").click(function(){
    $("#myCarousel").carousel("prev");
  });
  $(".carousel-control-next").click(function(){
    $("#myCarousel").carousel("next");
  });
});
</script>

<script type="text/javascript">
  function Validate() {
      var nama = document.getElementById("nama_pelanggan").value;
      var username = document.getElementById("username").value;
      var email = document.getElementById("email_pelanggan").value;
      var phone_number = document.getElementById("phone_number").value;
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("konfirmasi_pass").value;
      var persetujuan = document.getElementById("checkpersetujuan").checked;
      if (persetujuan == false) {
          alert("Anda belum menyetujui persetujuan");
          return false;
      }elseif(password != confirmPassword)
      {
          alert("Passwords do not match.")
          return false;
      }
      return true;
  }
</script>

<script>
$(document).ready(function(){
  
  $(window).scroll(function(){
    if ($(this).scrollTop() > 100) 
    {
      $('.scroll_To_Top').fadeIn();
    } 
    else 
    {
      $('.scroll_To_Top').fadeOut();
    }
  });
  
  $('.scroll_To_Top').click(function(){
    $('html, body').animate({scrollTop : 0},1500);
    return false;
  });
  
});
</script>

<script>
$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
  });
</script>

<script>
  $("video").prop('muted', true);
</script>

<script type="text/javascript">
  var checkBoxes = $('#checkpersetujuan');
  checkBoxes.change(function () {
  $('#daftar').prop('disabled', checkBoxes.filter(':checked').length < 1);
  });
  checkBoxes.change();
</script>

<script>
function myJasa2() {
  var str = document.getElementById("jasa2").value;
  var arr = str.split("|");
  var x = document.getElementById("jasa2").innerHTML = arr[0];
  if (x === '1'){ 
    document.getElementById("catatan").disabled = false;
  }
}
</script>

<script>
function myJasa3() {
  var str = document.getElementById("jasa3").value;
  var arr = str.split("|");
  var x = document.getElementById("jasa3").innerHTML = arr[0];
  if (x === '2'){ 
    document.getElementById("catatan").disabled = false;
  }
}
</script>

<script>
function myDecoy() {
  var str = document.getElementById("decoy").value;
  var arr = str.split("|");
  var x = document.getElementById("decoy").innerHTML = arr[0];
  if (x === 'Decoy'){ 
    document.getElementById("catatan").disabled = true;
  }
}
</script>

<script>
$("#jasa").change(function() {
  var combined = 0;
      combined = parseInt(this.value.split('|')[1]);  // here you'll get the second value, [0] will get the first one
  $("#totalongkir").val(combined);
  $("#totalOngkir").text(formatNumber(combined));
}).trigger("change");
</script>

<script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$("#jasa").change(function() {
  var total = parseFloat(document.getElementById("totalpembelian").value);
  var ongkir = parseFloat(document.getElementById("totalongkir").value);  // here you'll get the second value, [0] will get the first one
  $("#totaltagihan").val(total+ongkir);
  $("#totalTagihan").text(formatNumber(total+ongkir));
}).trigger("change");
</script>

<script>
$("#jasa2").change(function() {
  var combined = 0;
      combined = parseInt(this.value.split('|')[1]);  // here you'll get the second value, [0] will get the first one
  $("#totalongkir").val(combined);
  $("#totalOngkir").text(combined);
}).trigger("change");
</script>

<script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$("#jasa2").change(function() {
  var total = parseFloat(document.getElementById("totalpembelian").value);
  var ongkir = parseFloat(document.getElementById("totalongkir").value);  // here you'll get the second value, [0] will get the first one
  $("#totaltagihan").val(total+ongkir);
  $("#totalTagihan").text(formatNumber(total+ongkir));
}).trigger("change");
</script>

<script>
$("#jasa3").change(function() {
  var combined = 0;
      combined = parseInt(this.value.split('|')[1]);  // here you'll get the second value, [0] will get the first one
  $("#totalongkir").val(combined);
  $("#totalOngkir").text(combined);
}).trigger("change");
</script>

<script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$("#jasa3").change(function() {
  var total = parseFloat(document.getElementById("totalpembelian").value);
  var ongkir = parseFloat(document.getElementById("totalongkir").value);  // here you'll get the second value, [0] will get the first one
  $("#totaltagihan").val(total+ongkir);
  $("#totalTagihan").text(formatNumber(total+ongkir));
}).trigger("change");
</script>

<script>
$("#decoy").change(function() {
  var combined = 0;
      combined = parseInt(this.value.split('|')[1]);  // here you'll get the second value, [0] will get the first one
  $("#totalongkir").val(combined);
  $("#totalOngkir").text(combined);
}).trigger("change");
</script>

<script>
function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
$("#decoy").change(function() {
  var total = parseFloat(document.getElementById("totalpembelian").value);
  var ongkir = parseFloat(document.getElementById("totalongkir").value);  // here you'll get the second value, [0] will get the first one
  $("#totaltagihan").val(total+ongkir);
  $("#totalTagihan").text(formatNumber(total+ongkir));
}).trigger("change");
</script>

</body>
</html>