<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>SRMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

        <!-- Plugins css-->
        <link href="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url(); ?>assets/libs/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
		
		<!-- third party css -->
        <link href="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> <!-- third party css -->
        <link href="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">
            
            <!-- Topbar Start -->
				<?php include('includes/top-nav-bar.php'); ?>
            <!-- end Topbar --> <!-- ========== Left Sidebar Start ========== -->

<!-- Lef Side bar -->
<?php include('includes/sidebar.php'); ?>
<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">STUDENT'S DASHBOARD</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Currently login to <b>SY <?php echo $this->session->userdata('sy');?> <?php echo $this->session->userdata('semester');?></b></a></li>
											<li class="breadcrumb-item"><a href="#">Status: <span style="color:red;"><b>
														<?php	
															if(!$data1)
															{
																//the value is null
															   echo "Not Enrolled";
															}
															else
																{echo $data1[0]->Status;} ?></b></span></a></li>
										</ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

								<div class="row">
										<div class="col-sm-6 col-xl-3">
										<div class="card bg-primary">
											<div class="card-body text-center">
												<div class="h2 mt-2 text-white">
													<?php	
															if(!$data1)
															{
																//the value is null
															   echo "Not Enrolled";
															}
															else
																{echo $data1[0]->Status;} ?>
												</div>
												<span class="mb-2 text-white">Enrollment Status</span>
											</div>
										</div>
									</div>
										<div class="col-sm-6 col-xl-3">
										<div class="card bg-success">
											<div class="card-body text-center">
											<a href="<?= base_url(); ?>Masterlist/COR">
												<div class="h2 mt-2 text-white">
													<?php	
															if(!$data4)
															{
																//the value is null
															   echo "0.00";
															}
															else
																{echo $data4[0]->subjectCounts;} ?>
												</div>
												<span class="mb-2 text-white">Enrolled Subjects</span></a>
											</div>
										</div>
									</div>
									<div class="col-sm-6 col-xl-3">
										<div class="card bg-warning">
											<div class="card-body text-center">
											<a href="<?= base_url(); ?>Page/studeEnrollHistory">
												<div class="h2 mt-2 text-white">
													<?php	
															if(!$data3)
															{
																//the value is null
															   echo "0.00";
															}
															else
																{echo $data3[0]->SemesterCounts;} ?>
												</div>
												<span class="mb-2 text-white">Total Semesters Enrolled</span></a>
											</div>
										</div>
									</div>
									
									
									<div class="col-sm-6 col-xl-3">
										<div class="card bg-purple">
											<div class="card-body text-center">
												<div class="h2 mt-2 text-white">
												<?php	
															if(!$data2)
															{
																//the value is null
															   echo "0.00";
															}
															else
																{echo number_format($data2[0]->CurrentBalance,2);} ?>
												</div>
												<span class="mb-2 text-white">Current Balance</span>
											</div>
										</div>
									</div>
					
								</div>
							
								<div class="row">
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
							</div>
                        </div>
						

                            </div>
                            <!-- end col -->


                        </div>
                        <!-- End row -->

                    </div>
                    <!-- end container-fluid -->

                </div>
                <!-- end content -->

                

                <!-- Footer Start -->
					<?php include('includes/footer.php'); ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        
        <!-- Right Sidebar -->
			<?php include('includes/themecustomizer.php'); ?>
        <!-- /Right-bar -->


        <!-- Vendor js -->
        <script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>

        <script src="<?= base_url(); ?>assets/libs/moment/moment.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/jquery-scrollto/jquery.scrollTo.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
		
		<script src="<?= base_url(); ?>assets/libs/fullcalendar/fullcalendar.min.js"></script>

		<!-- Calendar init -->
		<script src="<?= base_url(); ?>assets/js/pages/calendar.init.js"></script>

        <!-- Chat app -->
        <script src="<?= base_url(); ?>assets/js/pages/jquery.chat.js"></script>

        <!-- Todo app -->
        <script src="<?= base_url(); ?>assets/js/pages/jquery.todo.js"></script>

        <!--Morris Chart-->
        <script src="<?= base_url(); ?>assets/libs/morris-js/morris.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/raphael/raphael.min.js"></script>

        <!-- Sparkline charts -->
        <script src="<?= base_url(); ?>assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- Dashboard init JS -->
        <script src="<?= base_url(); ?>assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="<?= base_url(); ?>assets/js/app.min.js"></script>

    <script src="<?= base_url(); ?>assets/libs/jquery-ui/jquery-ui.min.js"></script>
        <!-- Required datatable js -->
        <script src="<?= base_url(); ?>assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/pdfmake/vfs_fonts.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/buttons.print.min.js"></script>

        <!-- Responsive examples -->
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.select.min.js"></script>

        <!-- Datatables init -->
        <script src="<?= base_url(); ?>assets/js/pages/datatables.init.js"></script>

    </body>
</html>