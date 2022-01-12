<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>slc.ico">

	<!-- Stylesheets
	============================================= -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" /> -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url() ?>style.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/magnific-popup.css" type="text/css" />

	<!-- Bootstrap Select CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/bs-select.css" type="text/css" />


	<link rel="stylesheet" href="<?= base_url('assets/css/custom.css?v='.filemtime('./assets/css/custom.css')) ?>" type="text/css" />



	<!-- Bootstrap Data Table Plugin -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/bs-datatable.css" type="text/css" />


		<!-- Date & Time Picker CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/timepicker.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/daterangepicker.css" type="text/css" />

	<!-- Bootstrap File Upload CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/bs-filestyle.css" type="text/css" />


	<!-- Bootstrap Select CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/components/bs-select.css" type="text/css" />

	<!-- Switch alert -->
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/src/sweetalert2/sweetalert2.css')?>">


	<script src="<?= base_url('assets/js/jquery.js?v='.filemtime('./assets/js/jquery.js'))?>"></script>
			
	




	<!-- Document Title
	============================================= -->

	<style>



		/* thai */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aAFJn2QN.woff2') ?>) format('woff2');
			unicode-range: U+0E01-0E5B, U+200C-200D, U+25CC;
		}

		/* vietnamese */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aBpJn2QN.woff2') ?>) format('woff2');
			unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
		}

		/* latin-ext */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aBtJn2QN.woff2') ?>) format('woff2');
			unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
		}

		/* latin */
		@font-face {
			font-family: 'Sarabun';
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: local('Sarabun Regular'), local('Sarabun-Regular'), url(<?= base_url('assets/fonts/DtVjJx26TKEr37c9aBVJnw.woff2') ?>) format('woff2');
			unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
		}

		* {
			font-family: 'Sarabun', sans-serif;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		label {
			font-family: 'Sarabun', sans-serif !important;
		}

		body {
			font-size: .9rem !important;
		}

		.form-control {
			font-size: .9rem !important;
		}

		.process-steps li h5 {
			font-size: .85rem !important;
		}

		.col-search-input {
			width: 100% !important;
		}


		
	</style>


</head>
<?=getModal("templates/add_modal")?>
<?=getModal("templates/create_modal")?>
<?=getModal("templates/runscreen_modal")?>
<?=getModal("templates/spoint_modal")?>
<?=getModal("templates/runs_modal")?>
<?=getModal("templates/temp_detail_modal")?>
<?=getModal("templates/bom_modal")?>
<?=getModal("templates/setshift_modal")?>
<?=getModal("templates/supset_modal")?>
<?=getModal("templates/feedercheck_modal")?>
<?=getModal("templates/cancel_modal")?>

<!-- New Zone -->
<?=getModal("templates/create_template_modal")?>
<?=getModal("templates/select_template_modal")?>
<?=getModal("templates/qcsampling_modal")?>

<div class="loader">
	<div></div>
</div>

<script>
	 // Code page Load
	$(window).on('load',function(){
    $('.loader').fadeOut(1000);
  })
</script>

<body class="stretched">






	<!-- Document Wrapper
	============================================= -->
	<div id="mainwrapper" class="" >

		<!-- Top Bar
		============================================= -->
		<div id="top-bar">
			<div class="container">

				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-auto">
						<!-- <p class="mb-0 py-2 text-center text-md-left"><strong>Call:</strong> 1800-547-2145 | <strong>Email:</strong> info@canvas.com</p> -->
					</div>

					<div class="col-12 col-md-auto">

						<!-- Top Links
						============================================= -->
						<div class="top-links on-click">
							<ul class="top-links-container">
							<input hidden type="text" name="checkpage" id="checkpage" value="<?=$this->uri->segment(1)?>">
							<input hidden type="text" name="checkSessionEcode" id="checkSessionEcode" value="<?=getUser()->ecode?>">
							<input hidden type="text" name="checkPosi" id="checkPosi" value="<?=getUser()->posi?>">
							<input hidden type="text" name="checkDeptCode" id="checkDeptCode" value="<?=getUser()->DeptCode?>">


								<li id="nonelogin" class="top-links-item"><a href="#">เข้าสู่ระบบ</a>
									<div class="top-links-section">
										<form id="top-login" autocomplete="off">
											<div class="form-group">
												<label>ชื่อผู้ใช้งาน</label>
												<input type="text" class="form-control" placeholder="Username">
											</div>
											<div class="form-group">
												<label>รหัสผ่าน</label>
												<input type="password" class="form-control" placeholder="Password" required="">
											</div>
											<div class="form-group form-check">
												<input class="form-check-input" type="checkbox" value="" id="top-login-checkbox">
												<label class="form-check-label" for="top-login-checkbox">จดจำฉัน</label>
											</div>
											<button class="btn btn-danger btn-block" type="submit">เข้าสู่ระบบ</button>
										</form>
									</div>
								</li>


								<li style="display:none;" id="loginalready" class="top-links-item">
									<a href="#">สวัสดี คุณ <?=getUser()->Fname." ".getUser()->Lname?></a>
									<ul class="top-links-sub-menu subMenuArea">
										<li class="top-links-item"><a href="<?= base_url('login/logout') ?>" class="txtLogout" onclick="return confirm('คุณต้องการลงชื่อออกจากระบบใช่หรือไม่ ?')"><i class="icon-line-log-out iconLogout"></i>ออกจากระบบ</a></li>
									</ul>
								</li>

							</ul>
						</div><!-- .top-links end -->

					</div>
				</div>

			</div>
		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="<?=base_url()?>" class="standard-logo" data-dark-logo="<?= base_url('assets/') ?>images/logo-dark.png"><img src="<?= base_url('assets/') ?>images/msd_logo.png" alt="Canvas Logo"></a>
							<a href="<?=base_url()?>" class="retina-logo" data-dark-logo="<?= base_url('assets/') ?>images/logo-dark@2x.png"><img src="<?= base_url('assets/') ?>images/msd_logo.png" alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100">
								<path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
								<path d="m 30,50 h 40"></path>
								<path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
							</svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu mobile-menu-off-canvas" id="apps">

							<ul class="menu-container" id="navmainmenu">
								<li id="m_home" class="menu-item">
                                    <a class="menu-link" href="<?=base_url()?>">
										<div>หน้าหลัก</div>
									</a>
                                </li>
								<!-- Mega Menu
								============================================= -->
								<!-- <li id="m_add" class="menu-item"><a class="menu-link" href="<?= base_url('listdata.html') ?>">
										<div>คลังข้อมูลของเรา</div><span>Latest News</span>
									</a>

								</li> -->

								<li id="m_list" class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#">
										<div>ตั้งค่า</div>
									</a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col-lg-12">

													<ul class="sub-menu-container">
														<li class="menu-item"><a class="menu-link" href="<?=base_url('setting.html')?>"><div>ตั้งค่า Templates</div></a></li>
														<!-- <li class="menu-item"><a class="menu-link" href="<?=base_url('setting_main.html')?>"><div>ตั้งค่าข้อมูลหลัก</div></a></li> -->
													</ul>

												</ul>
											</div>
										</div>
									</div>
								</li>
                                <!-- .mega-menu end -->
                                <!-- <li id="m_manual" class="menu-item">
                                    <a class="menu-link" id="" href="">
										<div>เพิ่มข้อมูล</div><span>Latest News</span>
									</a>
                                </li> -->

								<li id="m_manual" class="menu-item">
								<a class="menu-link" href="#">
										<div>วิธีการใช้งาน</div><span>Latest News</span>
									</a>
                                </li>

							</ul>

						</nav><!-- #primary-menu end -->

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form>

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>

		</header><!-- #header end -->