<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Mustika Graha Education</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css')?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/iCheck/square/blue.css')?>">
	<style>
		body{
			background-image: url('<?= base_url('assets/dist/img/Kota-surabaya.jpg') ?>');
			background-size: cover;
			background-repeat: no-repeat;
		}
	</style>
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition">
	<div class="login-page bg-img"></div>
	<!-- LOGIN FORM -->
	<!--===================================================-->
	<div class="cls-content">
		<br><br><br><br><br>
		<div class="text-center"><h4 style="font-family:verdana;"><b>SELAMAT DATANG DI</b></h4></div>
		<br>
		<div class="col-lg-12 text-center"><b><h1 style="font-family:sans-serif;"><b>MUSTIKA GRAHA EDUCATION</b></h1></b></div>

		<div class="login-box">
  <div class="login-box-body">
    <p class="login-box-msg">Form Login</p>

    <form action="<?=site_url('Auth/login')?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="********">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  Login Sebagai :
	  
	  <div class="row">
		  <div class="form-check col-md-4">
			  <label class="form-check-label">
			  <input type="radio" class="form-check-input" name="hakAkses" id="AksesAdmin" value="1" checked>
			  Admin
			</label>
		  </div>
		  <div class="form-check col-md-4">
			  <label class="form-check-label">
			  <input type="radio" class="form-check-input" name="hakAkses" id="AksesInstansi" value="2">
			  Instansi
			</label>
		  </div>
		  <div class="form-check col-md-4">
			  <label class="form-check-label">
			  <input type="radio" class="form-check-input" name="hakAkses" id="AksesSiswa" value="3">
			  Siswa
			</label>
		  </div>
	  </div>
	  <br>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- <a href="#">I forgot my password</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
	</div>
	<!--===================================================-->

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
