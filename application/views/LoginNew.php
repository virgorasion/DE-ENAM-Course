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
			background-size:cover;
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
		<br><br><br><br><br><br><br>
		<div>
			<div class="form-group">
				<div class="row">
					<div class="text-center">
						<button id="loginAdmin" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-social btn-bitbucket"><i
							 class="fa fa-user fa-lg"></i> Login Admin</button>
						<button id="loginSekolah" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-social btn-bitbucket"><i
							 class="fa fa-university fa-lg"></i>Login Sekolah</button>
						<button id="loginSiswa" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-social btn-bitbucket"><i
							 class="fa fa-graduation-cap fa-lg"></i> Login Siswa</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--===================================================-->

	<!--Default Bootstrap Modal-->
	<!--===================================================-->
	<div class="modal fade" id="loginModal" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<!--Modal body-->
				<div class="modal-body">
					<button data-dismiss="modal" class="close" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="login-box">
						<div class="login-logo">
							<b>Login</b>
						</div>
						<!-- /.login-logo -->
						<div class="login-box-body">
							<p class="login-box-msg"></p>
							<form action="<?=site_url('Auth/Login')?>" method="post">
								<input type="hidden" name="<?=$csrf['token']?>" value="<?=$csrf['hash']?>">
								<div class="form-group has-feedback">
									<input type="text" class="form-control" name="username" placeholder="Username">
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
								</div>
								<div class="form-group has-feedback">
									<input type="password" class="form-control" name="password" placeholder="Password">
									<span class="glyphicon glyphicon-lock form-control-feedback"></span>
								</div>
								<input type="hidden" name="hakAkses" id="hakAkses" class="form-control" value="">
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
						</div>
						<!-- /.login-box-body -->
					</div>
					<!-- /.login-box -->
				</div>
			</div>
		</div>
	</div>
	<!--===================================================-->
	<!--End Default Bootstrap Modal-->

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

			$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
			});
		})

	</script>
</body>

</html>
