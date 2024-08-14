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
                                    <h4 class="page-title">Upload Proof of Payment</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb p-0 m-0">
                                            <li class="breadcrumb-item"><a href="#">Currently login to <b>SY <?php echo $this->session->userdata('sy');?> <?php echo $this->session->userdata('semester');?></b></a></li>
                                        </ol>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
					 
                        <!-- end page title -->
						 <div class="row">
						<div class="col-md-6">			
						<div class="card card-info">
						
							<?php echo $this->session->flashdata('msg'); ?>
							
							<div class="card-body">							
							<form action="<?php echo ('uploadPayments'); ?>" class="form-horizontal" enctype='multipart/form-data' method="POST" >
						<input type="hidden" class="form-control" name="StudentNumber" value="<?php echo $this->session->userdata('username');?>" readonly required >
						<input type="hidden" class="form-control" name="depositStat" value="For Verification" >
							
						<div class="card-body">
						  <div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Proof</label>
							<div class="col-sm-8">
							  <input type="file" class="form-control" name="nonoy" required >
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Amount</label>
							<div class="col-sm-8">
							  <input type="number" class="form-control" name="amountPaid" step="any" min="0" required >
							</div>
						  </div>
						  <div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Payment For</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" name="payment_for" required >
							</div>
						  </div>
							
							<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Semester</label>
							<div class="col-sm-8">
							  <select name="sem" class="form-control">
								<option value="<?php echo $this->session->userdata('semester');?>"><?php echo $this->session->userdata('semester');?></option>
							  
							  </select>
							</div>

							</div>
							<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">School Year</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" value="<?php echo $this->session->userdata('sy');?>" readonly name="sy" required >
							</div>
							</div>
							
							<div class="form-group row">
							<label for="inputEmail3" class="col-sm-4 col-form-label">Note/Message</label>
							<div class="col-sm-8">
							  <textarea name="note" class="md-textarea form-control" rows="3"></textarea>
							</div>
							</div>
						  
						  </div>
						  <input type="submit" name="submit" class="btn btn-info float-right" value="Upload">
						</div>
				
						  
						
			
						<!-- /.card-footer -->
					  </form>
						</div>
				</div>
	
				<div class="col-md-6">	
					<div class="card card-success">
					  <div class="card-header">
						<h3 class="card-title"> Summary of All Payments Made Online  </h3>
					  </div>
							<table class="table mb-0">

                                        <tr>
											<th>Payment For</th>
											<th>Applicable SY</th>
											<th>Status</th>
										</tr>
									 <?php
										  foreach($data1 as $row)
										  {
											  if(!$data1)
															{
																//the value is null
															   echo "No Records Found ";
															}
															else{
																
										 
										  echo "<tr>";
										  ?>
										  <td><?php echo $row->payment_for; ?></td>
										  <td><?php echo $row->sem.' '.$row->sy; ?></td>
										  <td><a href="<?= base_url(); ?>upload/payments/<?php echo $row->depositAttachment; ?>" target="_blank"><button type="button" class="btn btn-success btn-xs"> <?php echo $row->depositStat; ?></button></a></td>
										  <?php
										  
										  }}
										   ?>
										   
									</table>
				</div>
                        </div>	</div>
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