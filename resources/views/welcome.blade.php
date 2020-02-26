<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset ('imageforuser/warung.png') }}" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('comingsoon/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/itsfood.css') }}">

        <title>Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #28a745;
                background-color: #ffc107;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 32px;
            }

            .top {
                position: absolute;
                right: 200px;
                top: 0px;
            }

            .content {
                text-align: center;
            }

            .title {
                margin-top: 70px;
                font-size: 50px;
                color: #fff;
                font-family: Raleway;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="iconMakanan"><img src="{{ asset ('imageforuser/egg.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMakanan2"><img src="{{ asset ('imageforuser/iconmenu/shrimp.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMakanan3"><img src="{{ asset ('imageforuser/menu.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMakanan4"><img src="{{ asset ('imageforuser/iconmenu/chickenleg2.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMinuman"><img src="{{ asset ('imageforuser/drink1.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMinuman2"><img src="{{ asset ('imageforuser/iconmenu/iconteh.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMinuman3"><img src="{{ asset ('imageforuser/iconmenu/lemontea.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="iconMinuman4"><img src="{{ asset ('imageforuser/iconmenu/nasi.png') }}" class="card-img-top grow" alt="..."></div>
        <div class="d-flex justify-content-center position-ref full-height">   
            <div class="content">
                <div class="title m-b-md">
                <p class="asparagus-sprouts txt-center p-t-30 p-b-5 l1-txt2">
				    Welcome to Website
                </p>
                   <h1 style="font-family: segoe ui">Pecak Bandeng 59</h1>
                </div>

                <div class="links">
                    <a href="{{ url('pecakbandeng')}}">Website</a>
                </div><br>
                <center>
                    <a href="{{ url('pecakbandeng')}}">
                        <div>
                            <button class="how-btn-play1 flex-c-m">
                                <i class="zmdi zmdi-play"></i>
                            </button>
                        </div>
                    </a> 
                </center>
            </div>
        </div>

        <div class="flex-sb-m flex-w" style="margin:0 0 50px 70px">
			<!--  -->
			<div class="flex-w flex-c-m m-t-0 m-b-0">
				<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-3 m-t-3">
					<i class="fa fa-instagram"></i>
				</a>

				<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-3 m-t-3">
					<i class="fa fa-facebook"></i>
				</a>

				<a href="#" class="size3 flex-c-m how-social trans-04 m-r-3 m-l-3 m-b-3 m-t-3">
					<i class="fa fa-youtube-play"></i>
				</a>
			</div>

    <script src="{{ asset('comingsoon/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('comingsoon/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/countdowntime/moment.min.js') }}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/moment-timezone.min.js') }}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/moment-timezone-with-data.min.js') }}"></script>
	<script src="{{ asset('comingsoon/vendor/countdowntime/countdowntime.js') }}"></script>

        <script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 19,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{ asset('comingsoon/js/main.js') }}"></script>
    </body>
</html>
