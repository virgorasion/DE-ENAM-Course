<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mustika Graha Education</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" 	   href="<?= base_url('assets/cssLogin/images/icons/favicon.ico') ?>"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/bootstrap/css/bootstrap.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/fonts/iconic/css/material-design-iconic-font.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/animate/animate.css') ?>">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/css-hamburgers/hamburgers.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/animsition/css/animsition.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/select2/select2.min.css') ?>">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/daterangepicker/daterangepicker.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/css/main.css') ?>">
	<!--===============================================================================================-->

<link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/iCheck/square/blue.css')?>">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<style>
    body{
      background-image: url('<?= base_url('assets/cssLogin/images/bg-01.jpg') ?>');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body class="hold-transition">
	<div class="login-page bg-img"></div>
	<!-- LOGIN FORM -->
	<!--===================================================-->
	<div class="cls-content">
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/cssLogin/images/bg-01.jpg');">
		<div class="text-center"><h4><b class="class="login100-form-title p-b-34 p-t-27"">SELAMAT DATANG DI</b></h4></div>
		<div class="col-lg-12 text-center"><b><h1><b class="class="login100-form-title p-b-34 p-t-27"">MUSTIKA GRAHA EDUCATION</b></h1></b></div>
			<div class="wrap-login100">
				<form action="<?= site_url('Auth/login') ?>" method="post" class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div style="color:white; font-family:verdana;">
					Login Sebagai :
					</div>
	  
					  <div class="row">
						  <div class="form-check col-md-4">
							 <label class="form-check-label" style="color:white;">
							  <input type="radio" class="form-check-input" name="hakAkses" id="AksesAdmin" value="1" checked>
							  Admin
							</label>
						  </div>
						  <div class="form-check col-md-4">
							 <label class="form-check-label" style="color:white;">
							  <input type="radio" class="form-check-input" name="hakAkses" id="AksesInstansi" value="2">
							  Instansi
							</label>
						  </div>
						  <div class="form-check col-md-4">
							 <label class="form-check-label" style="color:white;">
							  <input type="radio" class="form-check-input" name="hakAkses" id="AksesSiswa" value="3">
							  Siswa
							</label>
						  </div>
					  </div><br><br>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

	</div>
	<!--===================================================-->
	<script src="<?= base_url('assets/cssLogin/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/vendor/animsition/js/animsition.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/vendor/bootstrap/js/popper.js') ?>"></script>
	<script src="<?= base_url('assets/cssLogin/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/vendor/select2/select2.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/vendor/daterangepicker/moment.min.js') ?>"></script>
	<script src="<?= base_url('assets/cssLogin/vendor/daterangepicker/daterangepicker.js ') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/vendor/countdowntime/countdowntime.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/js/main.js') ?>"></script>

	<!-- jQuery 3 -->
  <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
  <!-- iCheck -->
  <script src="<?= base_url('assets/plugins/iCheck/icheck.min.js')?>"></script>

	<script>
		$(document).ready(function () {
			$('#loginAdmin').click(function () {
				$('#hakAkses').val('1');
			});
			$('#loginSekolah').click(function () {
				$('#hakAkses').val('2');
			});
			$('#loginSiswa').click(function () {
				$('#hakAkses').val('3');
			});

			$(".alert").fadeTo(2000, 500).slideUp(500, function(){
				$(".alert").slideUp(500);
			});
		})

	</script>
</body>

</html>
