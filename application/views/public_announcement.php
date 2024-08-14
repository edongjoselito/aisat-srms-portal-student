<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>School Records Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(); ?>assets/img/favicon.png" rel="icon">
  <link href="<?= base_url(); ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

 <!-- =======================================================
  * Template Name: Medicio - v2.1.0
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= 
 <?php include('includes/web-top-bar.php'); ?>

  <!-- ======= Header ======= -->
	 <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <a href="<?= base_url(); ?>Login" class="logo mr-auto"><img src="<?= base_url(); ?>assets/img/logo.png" alt=""></a>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo mr-auto"><a href="index.html">Medicio</a></h1> -->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="<?= base_url(); ?>Login">Home</a></li>
          <!--<li><a href="<?= base_url(); ?>SRMS/about">About</a></li>-->
          <li class="active"><a href="<?= base_url(); ?>SRMS/announcement">Announcement</a></li>
          <li><a href="<?= base_url(); ?>SRMS/faq">Help</a></li>
		  <li><a href="<?= base_url(); ?>Login/login">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

     
    </div>
  </header>
  <!-- End Header -->


  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Announcements</h2>
          
		  
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">
      <div class="container">
        <div class="col-md-12">
										  <!-- Default box -->
													  <?php
													foreach($data as $row)
													{
												  ?>						  
											  <div class="card">
												<div class="card-header py-3 bg-transparent">
												<div class="card-widgets">
													<a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
													<a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
													<a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
												</div>
													<h5 class="header-title mb-0"><?php echo $row->title; ?></h5>
													
												</div>
												<div id="cardCollpase1" class="collapse show">
                                       
												<div class="card-body">
												  <img src="<?= base_url(); ?>upload/announcements/<?php echo $row->announcement; ?>" class="img-fluid" alt="Announcement" style="width:100%;">
												</div>
													 
												<!-- /.card-body -->
												<div class="card-footer">
												 _
												</div>
														
												<!-- /.card-footer-->
											  </div>
											 <?php } ?>
											  <!-- /.card -->
											  </div>
											  </div>
      </div>
    </section>

  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>School Records Management System</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medicio-free-bootstrap-theme/ -->
        Powered by <a href="https://softtechservices.net/" target="_blank">SoftTech Solutions</a>
      </div>
    </div>
  </footer><!-- End Footer -->
  
  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url(); ?>assets/vendor/aos/aos.js"></script>


  <!-- Template Main JS File -->
  <script src="<?= base_url(); ?>assets/js/main.js"></script>

 
	
</body>

</html>