<div class="col-12 p-3 bg-success text-white" id="about"> <!-- if error add 'h3' -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
            <div class="row no-gutters p-0">
                <div class="col-12" style="font-family:bebas neue">
                    <img src="{{ asset ('/imageforuser/warung.png') }}" style="width:100px; height:100px; margin-right:10px;"> PECAK BANDENG 59
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <div class="row no-gutters p-0">
                        <div class="popPhone growSosmed">
                            <i class="fa fa-mobile-alt fa-2x mt-3"></i>
                            <span class="popPhonetext badge badge-dark">0878-0898-8059</span>
                        </div>
                        <div class="popFacebook growSosmed">
                            <i class="fab fa-facebook fa-2x mt-3 ml-3 growSosmed"></i>
                            <span class="popFacebooktext badge badge-dark">we haven't an account in facebook</span>
                        </div>
                        <div class="popInstagram growSosmed">
                            <i class="fab fa-instagram fa-2x mt-3 ml-3 growSosmed"></i>
                            <span class="popInstagramtext badge badge-dark">we haven't an account in instagram</span>
                        </div>
                        <div class="popMail growSosmed">
                            <i class="far fa-envelope fa-2x mt-3 ml-3 growSosmed"></i>
                            <span class="popMailtext badge badge-dark">pecakbandeng59@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-9">
            <h5 class="card-title">PECAK BANDENG 59</h5>
			<p class="card-text">
                Pecak Bandeng 59 merupakan sebuah rumah makan yang menyediakan beberapa menu makanan dan minuman dimana
                tersedia menu pecak bandeng itu sendiri, berbagai macam olahan ayam seperti ayam goreng, ayam bakar, 
                ayam penyet, ayam bakar penyet, pala ayam, berbagai macam olahan tempe dan tahu, pecel lele, sayur asem, 
                berbagai olahan kangkung dan berbagai macam minuman. <br>
                <img src="{{ asset ('imageforuser/location.png') }}" width="30px" height="30px" class="d-inline-block align-top mt-2" alt=""> <span class="badge badge-warning mt-3">Jl. Raya Banten No.59, Unyur, Kec. Serang, Kota Serang, Banten 42111</span>
            </p>
        </div>
    </div>
    <hr class="bg-dark" style="height: 3px">
    <center>
        <div class="col-12">
            <i class="fas fa-copyright"></i> {{Carbon\Carbon::now()->format('Y')}} 
            <a href="#" class="badge badge-warning">
                PecakBandeng.Or.Id.
            </a> 
            All Rights Reserved.
        </div>
    </center>
</div>