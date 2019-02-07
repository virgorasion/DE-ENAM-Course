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
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/vendor/css-hamburgers/hamburgers.min.css') ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/css/util.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/cssLogin/css/main.css') ?>">
	<!--===============================================================================================-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<style>
    body{
      background-image: url('<?= base_url('assets/cssLogin/images/bg-01.jpg') ?>');
      background-size: cover;
      background-repeat: no-repeat;
	}
	.hidden {
		display: none;
	}
	p{
		color: white;
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
				<?php echo form_open_multipart('Auth/Registrasi');?>
					<span class="login100-form-title p-b-20">
						Registration
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter nama">
						<input class="input100" type="text" value="<?= set_value('nama')?>" name="nama" placeholder="Name">
						<span class="focus-input100" data-placeholder="&#xf205;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter Number">
						<input class="input100" type="text" value="<?= set_value('telpon')?>" name="telpon" placeholder="Nomor Telpon">
						<span class="focus-input100" data-placeholder="&#xf2be;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter Instansi">
						<input class="input100" type="text" value="<?= set_value('instansi')?>" name="instansi" placeholder="Instansi">
						<span class="focus-input100" data-placeholder="&#xf112;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter Jurusan">
						<input class="input100" type="text" value="<?= set_value('jurusan')?>" name="jurusan" placeholder="Jurusan">
						<span class="focus-input100" data-placeholder="&#xf174;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter NIS">
						<input class="input100" type="text" value="<?= set_value('nis')?>" name="nis" placeholder="NIS">
						<span class="focus-input100" data-placeholder="&#xf13a;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter NISN">
						<input class="input100" type="text" value="<?= set_value('nisn')?>" name="nisn" placeholder="NISN">
						<span class="focus-input100" data-placeholder="&#xf13a;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" value="<?= set_value('username')?>" name="username" placeholder="Username" value="" autocomplete="off">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>
					
					<div class="wrap-input100" data-validate="Enter password">
						<input type="file" id="foto" class="input100" name="foto">
						<div><?= @$error ?></div>
						<div><?= @$name ?></div>
						<span class="focus-input100" data-placeholder="&#xf28c;"></span>
					</div>

						<img id="img" class="p-b-20 hidden" alt="foto profile" src="#">
                    
					<div class="container-login100-form-btn">
						<button type="submit" name="submit" class="login100-form-btn">
							Submit
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
	<script src="<?= base_url('assets/cssLogin/vendor/countdowntime/countdowntime.js') ?>"></script>
<!--===============================================================================================-->

	<script src="<?= base_url('assets/cssLogin/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<!--===============================================================================================-->
	<script src="<?= base_url('assets/cssLogin/js/main.js') ?>"></script>
<!--===============================================================================================-->


	<script>
	function readURL(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
		$("#img").removeClass("hidden");
		$('#img').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
		}
	}

	$("#foto").change(function() {
	readURL(this);
	});

		$(document).ready(function () {
			$(".alert").fadeTo(2000, 500).slideUp(500, function(){
				$(".alert").slideUp(500);
			});
		})
	</script>
</body>

</html>