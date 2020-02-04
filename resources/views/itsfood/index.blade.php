<!DOCTYPE html>
<html lang="en">
<head>
    <title>Its Food</title>
    <link href="{{ asset('css/itsfood.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slim.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
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
	<!-- <div class="se-pre-con"></div> -->
</div>
<script>$('div.alert').delay(5000).slideUp(300);</script>
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/video.js') }}"></script>
<script>
$(document).on("click", ".review", function () {
     var Id = $(this).data('id');
     var Id_Produk = $(this).data('idproduk');
     var Nama_Produk = $(this).data('namaproduk');
     $(".modal-body #id_pelanggan").val( Id );
     $(".modal-body #id_produk").val( Id_Produk );
     $(".modal-body #nama_produk").text( Nama_Produk );
});
</script>

<script>
$(document).on("click", ".reviewsearch", function () {
     var Id = $(this).data('id');
     var Id_Produk = $(this).data('idproduk');
     var Nama_Produk = $(this).data('namaproduk');
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
     $(".modal-body #id_review").val( Id_Review );
     $(".modal-footer #id_review_delete").val( Id_Review );
     $(".modal-body #id_pelanggan").val( Id );
     $(".modal-body #id_produk").val( Id_Produk );
     $(".modal-body #nama_produk").text( Nama_Produk );
     $(".modal-body #review").val( Review );
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

<script>
  // When the user scrolls the page, execute myFunction
  window.onscroll = function () { myFunction() };

  // Get the navbar
  var navbar = document.getElementById("navbar");

  // Get the offset position of the navbar
  var sticky = navbar.offsetTop;

  // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }
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
      }elseif(password != confirmPassword){
          alert("Passwords do not match.")
          return false;
      }
      return true;
  }
</script>

<script src="https://code.jquery.com/jquery-2.1.1.js"></script>
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
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>

<script>
var slideIndexEvent = 0;
showSlidesEvent();

function showSlidesEvent() {
  var iEvent;
  var slidesEvent = document.getElementsByClassName("mySlidesEvent");
  for (iEvent = 0; iEvent < slidesEvent.length; iEvent++) {
    slidesEvent[iEvent].style.display = "none";  
  }
  slideIndexEvent++;
  if (slideIndexEvent > slidesEvent.length) {slideIndexEvent = 1}
  slidesEvent[slideIndexEvent-1].style.display = "block";
  setTimeout(showSlidesEvent, 7000); // Change image every 2 seconds
}
</script>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlidesMakanan");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>

<script>
var slideIndex2 = 0;
showSlides2();

function showSlides2() {
  var i2;
  var slides2 = document.getElementsByClassName("mySlidesMinuman");
  for (i2 = 0; i2 < slides2.length; i2++) {
    slides2[i2].style.display = "none";  
  }
  slideIndex2++;
  if (slideIndex2 > slides2.length) {slideIndex2 = 1}
  slides2[slideIndex2-1].style.display = "block";
  setTimeout(showSlides2, 3000); // Change image every 2 seconds
}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script>
$(window).load(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");;
  });
</script>

<script>
  $("video").prop('muted', true);

  // $("#mute-unmute").click( function (){
  //   if( $("video").prop('muted') ) {
  //         $("video").prop('muted', false);
  //   } else {
  //     $("video").prop('muted', true);
  //   }
  // });
</script>

<!-- tab -->
<script>
function openOption(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<script type="text/javascript">
  var checkBoxes = $('#checkpersetujuan');
  checkBoxes.change(function () {
  $('#daftar').prop('disabled', checkBoxes.filter(':checked').length < 1);
  });
  checkBoxes.change();
</script>

<script>
function myJasa() {
  var str = document.getElementById("jasa").value;
  var arr = str.split("|");
  var x = document.getElementById("jasa").innerHTML = arr[0];
  if (x === 'Dikirim'){ 
    // document.getElementById("kota").disabled = false;
    // document.getElementById("btn-kota").disabled = false;
    // document.getElementById("jasa_pengiriman").disabled = false;
    document.getElementById("alamat").disabled = false;
    document.getElementById("catatan").disabled = true;
  }
}
</script>
<script>
function myJasa2() {
  var str = document.getElementById("jasa2").value;
  var arr = str.split("|");
  var x = document.getElementById("jasa2").innerHTML = arr[0];
  if (x === 'Booking'){ 
    // document.getElementById("kota").disabled = true;
    // document.getElementById("btn-kota").disabled = true;
    // document.getElementById("jasa_pengiriman").disabled = true;
    document.getElementById("alamat").disabled = true;
    document.getElementById("catatan").disabled = false;
  }
}
</script>

<script>
function myJasa3() {
  var str = document.getElementById("jasa3").value;
  var arr = str.split("|");
  var x = document.getElementById("jasa3").innerHTML = arr[0];
  if (x === 'Diambil'){ 
    // document.getElementById("kota").disabled = true;
    // document.getElementById("btn-kota").disabled = true;
    // document.getElementById("jasa_pengiriman").disabled = true;
    document.getElementById("alamat").disabled = true;
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
    // document.getElementById("kota").disabled = true;
    // document.getElementById("btn-kota").disabled = true;
    // document.getElementById("jasa_pengiriman").disabled = true;
    document.getElementById("alamat").disabled = true;
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

<!-- <script>
  var priceevent = parseFloat(document.getElementById("priceevent").value);
  var price = parseFloat(document.getElementById("price").value);
  var total = document.getElementById("total").value = priceevent + price;
  $("#Total").text(total);
</script> -->
</body>
</html>