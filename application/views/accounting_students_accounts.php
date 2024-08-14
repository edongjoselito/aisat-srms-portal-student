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

        <!-- App css -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

		<!-- third party css -->
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
                            <div class="col-md-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Students' Accounts</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Currently login to <b>SY <?php echo $this->session->userdata('sy');?> <?php echo $this->session->userdata('semester');?></b></a></li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                     
						<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
										<form method="GET" class="form-inline"> 							               
										    <div class="form-group">
											   <select class="form-control" name="course" id="course" data-toggle="select2">
												<option>Select Course</option>
												<?php
											foreach ($course as $row) {
												echo '<option value="' . $row->CourseDescription . '">' . $row->CourseDescription . '</option>';
											}
											?>
												</optgroup>
											</select>&nbsp
											</div>
											<div class="form-group">
											<select name="yearlevel" class="form-control" data-toggle="select2">
												<option>Select Year Level</option>
												<option value="1st">1st Year</option>
												<option value="2nd">2nd Year</option>
												<option value="3rd">3rd Year</option>
												<option value="4th">4th Year</option>
											</select>&nbsp
											</div>
											
											<button type="submit" name="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</div>
						</div>
					 
                        <!-- end page title -->
						<div class="row">
						 <?php
							if(isset($_GET["submit"])) {
							?>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <h4 class="m-t-0 header-title mb-4"><b>Students' Accounts</b></h4>
										
										<!--<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">-->
										<table>
											<tr>
												<td>Course</td><td>: <b><?php echo $_GET['course']; ?></b></td>
											</tr>
											<tr>
												<td>Year Level</td><td>: <b><?php echo $_GET['yearlevel']; ?></b></td>
											</tr>
											<tr>
												<td>Sem./SY</td><td>:  <b><?php echo $this->session->userdata('semester');?>/<?php echo $this->session->userdata('sy');?></b></td>
											</tr>
										</table>
										<table class="table table-sm mb-0">
										<thead>
                                            <tr>
												<th>Student Name</th>
												<th>Year Level</th>
												<th>Course</th>
												<th style="text-align:center">Total Acct.</th>
												<th style="text-align:center">Discount</th>
												<th style="text-align:center">Payments</th>
												<th style="text-align:center">Balance</th>
											</tr>
                                        </thead>
                                        <tbody>
										

										<?php
										  $i=1;
										  foreach($data as $row)
										  {
										  echo "<tr>";
										  echo "<td>".$row->StudentName."</td>";
                                          ?>
										  <td><?php echo $row->YearLevel; ?></a></td>
                                          <td><?php echo $row->Course; ?></td>
										  <td style="text-align:right">
											<a href="<?= base_url(); ?>Accounting/studentStatement?id=<?php echo $row->StudentNumber; ?>">
												<?php echo $row->AcctTotal; ?>
											</a>
										  </td>
										  <td style="text-align:right"><?php echo $row->Discount; ?></td>
										  <td style="text-align:right">
											<a href="<?= base_url(); ?>page/studepayments?studentno=<?php echo $row->StudentNumber; ?>&sem=<?php echo $this->session->userdata('semester');?>&sy=<?php echo $this->session->userdata('sy');?>">
												<?php echo $row->TotalPayments; ?>
											</a>
											</td>
										  <td style="text-align:right"><?php echo $row->CurrentBalance; ?></td>
                                         <?php
										  echo "</tr>";
										  }
											?>
											
											<div class="d-print-none">
										<div class="float-right">
											<a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
											<a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
										</div>
									</div>	
											<?php
											}
											
										   ?>
										</tbody>
                                       
                                    </table>
									
									
						</div>
						</div>
						
						
						</div>
						</div>

												
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
		<script src="<?= base_url(); ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.select.min.js"></script>

        <!-- Datatables init -->
        <script src="<?= base_url(); ?>assets/js/pages/datatables.init.js"></script>
		
    </body>
</html>