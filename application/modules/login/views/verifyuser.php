<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Login - Layout 5 | Canvas</title>

</head>
<?= getModal() ?>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap py-0">

				<div class="section p-0 m-0 h-100 position-absolute" style="background: url('<?= base_url('assets/') ?>images/parallax/home/7.jpg') center center no-repeat; background-size: cover;"></div>

				<div class="section bg-transparent min-vh-100 p-0 m-0">
					<div class="vertical-middle">
						<div class="container-fluid py-5 mx-auto">
							<div class="center">
								<a href="index.html"><img src="<?= base_url('assets/') ?>images/kb3.png" alt="Canvas Logo"></a>
							</div>

							<div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
								<div class="card-body" style="padding: 40px;">

									<h3 class="text-center">Verify user</h3>
									<div class="row text-center">
										<div class="col-lg-12 form-group">
											<a href="#" data-toggle="modal" data-target="#md_verifyuser" class="button button-xlarge button-circle button-3d button-dirtygreen"><i class="icon-map-marker2"></i>Verify User</a>

										</div>
										<div class="col-lg-12 form-group">

											<a href="<?= base_url('logout.html') ?>" onclick="return confirm('คุณต้องการออกจากหน้านี้ใช่หรือไม่')" class="button button-small button-circle button-3d button-red"><i class="icon-play-circle"></i>Cancel</a>
										</div>
									</div>

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
	<script src="<?= base_url('assets/') ?>js/jquery.js"></script>
	<script src="<?= base_url('assets/') ?>js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?= base_url('assets/') ?>js/functions.js"></script>




</body>

</html>

<script>
$(document).ready(function(){
	$('#user_dept_confirm').change(function(){
		let dc = $(this).val();
		let dcn = $('#user_dept_confirm option:selected').text();
		$('#user_deptcode_confirm').val(dc);
		$('#user_deptname_confirm').val(dcn);
	})
})


</script>