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
                                    <h4 class="page-title">Announcement Posting</h4>
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
                            <div class="col-md-7">
							<?php echo $this->session->flashdata('msg'); ?>
                                <div class="card">
                                    <div class="card-body table-responsive">
                                       <h4 class="m-t-0 header-title mb-4"><b>Announcement Posting</b></h4>
										
										<form class="form-horizontal" action="<?php echo ('uploadAnnouncement'); ?>" enctype='multipart/form-data' method="POST" >
										<div class="card-body">
											<div class="form-group row">
											<label for="inputEmail3" class="col-md-4 col-form-label">Title</label>
											<div class="col-md-8">
											  <input type="text" class="form-control" name="title" placeholder="" required>
											</div>
										  </div>
										 <div class="form-group row">
											<label for="inputEmail3" class="col-md-4 col-form-label">Attach Image for Announcement </label>
											<div class="col-md-8">
											 <div class="col-sm-8">
												  <input type="file" class="form-control" name="nonoy" required >
												</div>
											<p style="color:red; text-align:justify">Note: Maximum image size should be: <span style="font-weight: bold">width=900px, height=600px, and resolution=100px</span>.  The acceptable formats are jpg, png and gif.</p>	
											</div>
										  </div>

										</div>
										<!-- /.card-body -->
										<div class="card-footer">
										  <input type="submit" name="submit" class="btn btn-info float-right" value="Save">
										</div>
										<!-- /.card-footer -->
									  </form>
								
						</div>
						</div>
						</div>
						
						<div class="col-md-5">
						            <div class="card">
                                    <div class="card-body table-responsive">
                                       <h4 class="m-t-0 header-title mb-4"><b>Announcement List</b></h4>
										
										 <table id="example1" class="table table-bordered table-striped">
                                       
										<thead>
                                            <tr>
												<th>Title</th>
												<th>Date Posted</th>
												<th></th>
										</tr>
                                        </thead>
                                        <tbody>
										

										<?php
										  foreach($data as $row)
										  {
										  echo "<tr>";
										  ?>
										  <td><a href="<?= base_url(); ?>upload/announcements/<?php echo $row->announcement; ?>" target="_blank"><?php echo $row->title; ?></a></td>
										  <td><?php echo $row->datePosted; ?></td>	
										  <td><a href='deleteAnnouncement?id=<?php echo $row->aID; ?>'><button type="button" class="btn btn-default btn-sm">Delete </a></button>
										   </td>	
										<?php
										
										 echo "</tr>";
									  
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