<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page | Nifty - Responsive admin template.</title>


    <!--STYLESHEET-->
    <!--=================================================-->



    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css")?>" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="<?php echo base_url("assets/css/nifty.min.css")?>" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMO ]-->
    <link href="<?php echo base_url("assets/css/demo/nifty-demo-icons.min.css")?>" rel="stylesheet">

    
    <!--Font Awesome [ OPTIONAL ]-->
    <link href="<?php echo base_url("assets/plugins/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo base_url("assets/css/demo/nifty-demo.min.css")?>" rel="stylesheet">




    <!--SCRIPT-->
    <!--=================================================-->

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="<?php echo base_url("assets/plugins/pace/pace.min.css")?>" rel="stylesheet">
    <script src="<?php echo base_url("assets/plugins/pace/pace.min.js")?>"></script>


    
    <!--

    REQUIRED
    You must include this in your project.

    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.

    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.

    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.

    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    -->
        
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
	<div id="container" class="cls-container">
		
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img img-balloon"></div>
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
            <br><br><br><br><br>
			<div class="text-center">SELAMAT DATANG DI</div>
            <br><br>
            <div class="col-lg-12 text-center">Web Fauzan</div>
            <br><br><br><br>
            <div>
                <div class="form-group">
                    <div class="row">
                        <div class="text-center">
                            <button id="loginAdmin" data-toggle="modal" data-target="#loginModal" class="btn btn-info btn-labeled fa fa-user fa-lg">Login Admin</button>
                            <button id="loginSekolah" data-toggle="modal" data-target="#loginModal" class="btn btn-info btn-labeled fa fa-university fa-lg">Login Sekolah</button>
                            <button id="loginSiswa" data-toggle="modal" data-target="#loginModal" class="btn btn-info btn-labeled fa fa-graduation-cap fa-lg">Login Siswa</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<!--===================================================-->
		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->

    <!--Default Bootstrap Modal-->
	<!--===================================================-->
	<div class="modal fade" id="loginModal" role="dialog" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">

				<!--Modal header-->
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button">
					<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Sign In to your account</h4>
				</div>

				<!--Modal body-->
				<div class="modal-body">

                    <form action="<?= site_url('MainController/login')?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<input type="text" class="form-control" name="username">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
								<input type="password" class="form-control" name="password">
							</div>
						</div>
                        <input type="hidden" name="hakAkse" id="hakAkse" class="form-control" value="">
						<div class="row">
							<div class="col-xs-1">
								<div class="form-group text-right">
								<button class="btn btn-success text-uppercase" type="submit">Sign In</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--===================================================-->
	<!--End Default Bootstrap Modal-->


		
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="<?php echo base_url("assets/js/jquery-2.2.1.min.js")?>"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js")?>"></script>

    <!--Fast Click [ OPTIONAL ]-->
    <script src="<?php echo base_url("assets/plugins/fast-click/fastclick.min.js")?>"></script>

    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="<?php echo base_url("assets/js/nifty.min.js")?>"></script>

    <script>
        $(document).ready(function(){
            $('#loginAdmin').click(function(){
                $('#hakAkse').val('1');
            });
            $('#loginSekolah').click(function(){
                $('#hakAkse').val('2');
            });
            $('#loginSiswa').click(function(){
                $('#hakAkse').val('3');
            });
        })
    </script>
</body>
</html>
