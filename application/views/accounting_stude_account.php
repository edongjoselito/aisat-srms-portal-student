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
                                    <h4 class="page-title">Statement of Account</h4>
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
                               
                                        <div >
                                            
                                            <form class="parsley-examples" method="post" accept-charset="utf-8">

                                            <div class="form-row">
                                            <div class="form-group col-md-4">
                                                    <label for="semester">Semester</label>
                                                    <select class="form-control" name="sem" required>
                                                    <option ></option>
                                                    <option >First Semester</option>
                                                    <option >Second Semester</option>
                                                 </select>
                                                </div> 
                                                <div class="form-group col-md-4">
                                                    <label for="lastName">School Year</label>
                                                    <input type="text" name="sy" class="form-control" placeholder="2023-2024" />
                                                    
                                                </div> 

                                            </div>
                                            <input type="submit" name="submit" value="View" class="btn btn-primary waves-effect waves-light mr-1">
                                            
                                        </form>
                                        
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!--- end row -->
                        
                        <!-- start row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- <div class="panel-heading">
                                                    <h4>Invoice</h4>
                                                </div> -->
                                    <div class="card-body">
                                        <div class="clearfix">
										
										  <div class="float-left">
                                                <h4><?php echo $data1[0]->SchoolName; ?><!--<img src="assets/images/logo-dark.png" height="18" alt="moltran">-->
												<br /><small><?php echo $data1[0]->SchoolAddress; ?></small>
												</h4>

                                            </div>
                                            <div class="float-right">
                                                <h5><strong>STATEMENT OF ACCOUNT</strong>
												<br /><small><?php echo $this->session->userdata('semester');?>, SY <?php echo $this->session->userdata('sy');?></small>
												</h5>
                                            </div>
                                        </div>
                                        <hr>
										
										<?php	
															if(!$data)
															{
																//the value is null
															   echo "No Records Found ";
															}
															else{
																?>
										
										
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="float-left mt-1">
                                                    <address>
                                                                <strong><?php echo $data[0]->FirstName.' '.$data[0]->MiddleName.' '.$data[0]->LastName; ?></strong><br>
                                                                <?php echo $data[0]->StudentNumber; ?><br>
                                                                <?php echo $data[0]->YearLevel; ?> Year, <?php echo $data[0]->Course; ?><br>
                                                                </address>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="mt-5"></div>
                                        <div class="row">
                                            <div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
													<div class="table-responsive">
														<h4 class="m-t-0 header-title mb-2"><b>Miscellaneous and Other Fees</b></h4>
														 <table class="table table-sm mb-0">
											
															 <?php
																  foreach($data as $row)
																  {
																 
																  echo "<tr>";
																  echo "<td>".$row->FeesDesc."</td>";
																  echo "<td style='text-align:right'>".number_format($row->FeesAmount,2)."</td>";
																  }
																   ?>
															</table>
													   
													</div>
													</div>
													
													<div class="col-md-6">
														<h4 class="m-t-0 header-title mb-2"><b>SUMMARY</b></h4>
														 <table class="table table-sm mb-0">
															<tr>
																<td>Misc. and Other Fees Total</td><td style="text-align:right"> <b><?php echo number_format($data[0]->TotalFees,2); ?></b></td>
															</tr>
															<tr>
																<td>Tuition Fee</td><td style="text-align:right"> <b><?php echo number_format($data[0]->tuitionDay,2); ?></b></td>
															</tr>
															<tr>
																<td>Total Account</td><td style="text-align:right"> <b><?php echo number_format($data[0]->AcctTotal,2); ?></b></td>
															</tr>
															<tr>
																<td>Total Discount</td><td style="text-align:right"> <b><?php echo number_format($data[0]->Discount,2); ?></b></td>
															</tr>
															<tr>
																<td>Total Payments</td><td style="text-align:right"> <b><?php echo number_format($data[0]->TotalPayments,2); ?></b></td>
															</tr>
														</table>
															
															<hr>
															<h4 class="text-right">Current Balance: <?php echo number_format($data[0]->CurrentBalance,2); ?></h4>
														
													</div>
												</div>
                                            </div>
                                        </div>
															<?php } ?>
                                        <hr>
                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                                <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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