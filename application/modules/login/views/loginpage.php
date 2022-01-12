<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url('assets/')?>css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?=base_url('assets/')?>css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>หน้าลงชื่อเข้าใช้งานระบบ Machine setup data (Farrel)</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap py-0">

				<div class="section p-0 m-0 h-100 position-absolute bglogin" style="background: url('<?=base_url('assets/')?>images/bg/loginfarrelbg.jpg') center center no-repeat; background-size: cover;"></div>

				<div class="section bg-transparent min-vh-100 p-0 m-0">
					<div class="vertical-middle">
						<div class="container-fluid py-5 mx-auto">
							<div class="center">
								<a href="index.html"><img src="<?=base_url('assets/')?>images/msd_logo.png" alt="Canvas Logo"></a>
							</div>

							<div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
								<div class="card-body" style="padding: 40px;">
									<form id="login-form" name="login-form" class="mb-0" action="<?=base_url('login/checklogin')?>" method="post" autocomplete="off">
										<h3>Login to your Account</h3>
                                        <?php echo $this->session->flashdata('msg');?>
										<div class="row">
											<div class="col-12 form-group">
												<label for="login-form-username">Username:</label>
												<input type="text" id="login_username" name="login_username" value="" class="form-control not-dark" required/>
											</div>

											<div class="col-12 form-group">
												<label for="login-form-password">Password:</label>
												<input type="password" id="login_password" name="login_password" value="" class="form-control not-dark" required/>
											</div>

											<div class="col-12 form-group">
												<button class="button button-3d button-black m-0" id="login_submit" name="login_submit" value="login">Login</button>
												<a href="#" class="float-right">Forgot Password?</a>
											</div>
										</div>
									</form>

									<div class="line line-sm"></div>

									<!-- <div class="w-100 text-center">
										<h4 style="margin-bottom: 15px;">or Login with:</h4>
										<a href="#" class="button button-rounded si-facebook si-colored">Facebook</a>
										<span class="d-none d-md-inline-block">or</span>
										<a href="#" class="button button-rounded si-twitter si-colored">Twitter</a>
									</div> -->
								</div>
							</div>

							<div class="text-center dark mt-3"><small>Copyrights &copy; All Rights Reserved by Saleecolour PLC.</small></div>
						</div>
					</div>
				</div>

			</div>
		</section><!-- #content end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?=base_url('assets/')?>js/jquery.js"></script>
	<script src="<?=base_url('assets/')?>js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?=base_url('assets/')?>js/functions.js"></script>

</body>
</html>