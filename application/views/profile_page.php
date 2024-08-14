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
                            <div class="col-sm-12">
                                <div class="profile-bg-picture" style="background-image:url('<?= base_url(); ?>assets/images/bg-profile.jpg')">
                                    <span class="picture-bg-overlay"></span>
                                    <!-- overlay -->
                                </div>
                                <!-- meta -->
                                <div class="profile-user-box">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php if($this->session->userdata('level')==='Student'):?>
											<div class="profile-user-img"><img src="<?= base_url(); ?>upload/profile/<?php echo $this->session->userdata('avatar');?>" alt="" class="avatar-lg rounded-circle"></div>
                                            
											<?php else:?>
												<div class="profile-user-img"><img src="<?= base_url(); ?>upload/profile/<?php echo $data1[0]->avatar; ?>" alt="" class="avatar-lg rounded-circle"></div>
											<?php endif;?>
											<div class="">
                                                <h4 class="mt-5 font-18 ellipsis"><?php echo $data[0]->FirstName.' '.$data[0]->MiddleName.' '.$data[0]->LastName; ?></h4>
                                                <p class="font-13"> <?php echo $data[0]->sitioPresent.' '.$data[0]->brgyPresent.', '.$data[0]->cityPresent.', '.$data[0]->provincePresent; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-right">
											
											<!--
                                                <button type="button" class="btn btn-success waves-effect waves-light">
                                                    
												  <?php if($this->session->userdata('level')==='Admin'):?>
												 <a href="<?= base_url(); ?>Page/updateStudeProfile?id=<?php echo $data[0]->StudentNumber; ?>"><b><i class="far fa-edit mr-1"></i><span> Edit Profile</span></b></a>

												  <?php elseif($this->session->userdata('level')==='Registrar'):?>
												  <a href="<?= base_url(); ?>Page/updateStudeProfile?id=<?php echo $data[0]->StudentNumber; ?>"><b><i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile</b></a>
												  
												  <?php elseif($this->session->userdata('level')==='Student'):?>
												  <a href="<?= base_url(); ?>Page/updateStudeProfile?id=<?php echo $this->session->userdata('username');?>"><b><i class="mdi mdi-account-settings-variant mr-1"></i> Edit Profile</b></a>
												   <?php endif;?>
                                                </button>
                                                  -->	
												<?php if($this->session->userdata('level')==='Student'):?>
												
												<?php else: ?>
												
												<a href=<?= base_url(); ?>stude_grades.php?view=<?php echo $data[0]->StudentNumber; ?> target="_blank">
													<button type="button" class="btn btn-success waves-effect waves-light">Complete Grades</button>
												</a>
												
												
												<a href="<?= base_url(); ?>page/enrollmentAcceptance?id=<?php echo $data[0]->StudentNumber; ?>&FName=<?php echo $data[0]->FirstName; ?>&MName=<?php echo $data[0]->MiddleName; ?>&LName=<?php echo $data[0]->LastName; ?>&Course=&YearLevel=&sem=&sy=">
													<button type="button" class="btn btn-danger waves-effect waves-light">Enroll</button>
												</a>
												<?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ meta -->
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="card p-0">
                                    <div class="card-body p-0">
                                        <ul class=" nav nav-tabs tabs-bordered nav-justified">
                                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#aboutme">About</a></li>
											<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#requirements">Submitted Requirements</a></li>
											<!--<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#grades">Grades</a></li>-->
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#accounthistory">Account History</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payments">Other Payments</a></li>
                                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#enrollmenthistory">Enrollment History</a></li>
											
                                        </ul>
										<?php echo $this->session->flashdata('msg'); ?>
                                        <div class="tab-content m-0 p-4">

                                            <div id="aboutme" class="tab-pane active">
                                                <div class="profile-desk">
                                                    <h4 class="mt-1 font-18 ellipsis">Student's Information</h4>
													<div class="row">
													<div class="col-sm-6">
													<!--<h5 class="mt-4">Official Information</h5>-->
													<table class="table table-condensed mb-0">
                                                        
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Student No.</th>
                                                                    <td>
                                                                         <?php echo $data[0]->StudentNumber; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Birth Date</th>
                                                                    <td>
                                                                            <?php echo $data[0]->birthDate; ?>
                                                                    </td>
                                                                </tr>

                                                                 <tr>
                                                                    <th scope="row">Age</th>
                                                                    <td>
                                                                            <?php echo $data[0]->age; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Sex</th>
                                                                    <td>
                                                                            <?php echo $data[0]->Sex; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Civil Status</th>
                                                                    <td>
                                                                         <?php echo $data[0]->CivilStatus; ?>
                                                                    </td>
                                                                </tr>
																<tr>
                                                                    <th scope="row">Mobile No.</th>
                                                                    <td>
                                                                            <?php echo $data[0]->contactNo; ?>
                                                                    </td>
                                                                </tr>
																 <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td>
                                                                            <?php echo $data[0]->email; ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
															
                                                        </table>
														</div>
													
													<div class="col-sm-6">
													<!--<h5 class="mt-4">Contact Person</h5>-->
													<table class="table table-condensed mb-0">
                                                        
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Father</th>
                                                                    <td>
                                                                         <?php echo $data[0]->father; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Occupation</th>
                                                                    <td>
                                                                            <?php echo $data[0]->fOccupation; ?>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th scope="row">Mother</th>
                                                                    <td>
                                                                            <?php echo $data[0]->mother; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Occupation</th>
                                                                    <td>
                                                                         <?php echo $data[0]->mOccupation; ?>
                                                                    </td>
                                                                </tr>
																 <tr>
                                                                    <th scope="row">Guardian</th>
                                                                    <td>
                                                                         <?php echo $data[0]->guardian; ?>
                                                                    </td>
                                                                </tr>
																 <tr>
                                                                    <th scope="row">Contact No.</th>
                                                                    <td>
                                                                         <?php echo $data[0]->guardianContact; ?>
                                                                    </td>
                                                                </tr>
																 <tr>
                                                                    <th scope="row">Address</th>
                                                                    <td>
                                                                         <?php echo $data[0]->guardianAddress; ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
															
                                                        </table>
														</div>
														</div>
                                                    </div> <!-- end profile-desk -->
                                                </div> <!-- about-me -->

                                               <div id="requirements" class="tab-pane">
											   <h4 class="mt-1 font-18 ellipsis">Submitted Requirements</h4>
                                                    <table class="table mb-0">
																<tbody>
																<tr>
																	<th>File Name</td>
																	<th style="text-align:center;">Date Uploaded</td>
																	<th></td>
																</tr>
															<?php
															  foreach($data2 as $row)
															  {
															  echo "<tr>";
															  ?>
															  <td><a href="<?= base_url(); ?>upload/requirements/<?php echo $row->fileAttachment; ?>" target="_blank"><?php echo $row->docName; ?></a></td>
																<td style="text-align:center;"><?php echo $row->dateUploaded; ?></td>
																<td style="text-align:right;"><a href="<?= base_url(); ?>upload/requirements/<?php echo $row->fileAttachment; ?>" target="_blank"><button type="button" class="btn btn-primary btn-xs waves-effect waves-light">View File</button></a></td>
															<?php 
															 echo "</tr>";
														  
																}
															   ?>
															</tbody>
														   
														</table>
                                                </div>
												<!-- Grades -->
                                                <div id="grades" class="tab-pane">
                                                    <h4 class="mt-1 font-18 ellipsis">Grades (<?php echo $this->session->userdata('semester');?>, SY <?php echo $this->session->userdata('sy');?>)</h4>
													<a href="<?= base_url(); ?>stude_grades.php?view=<?php echo $data[0]->StudentNumber; ?>" target="_blank"><!--<button type="button" class="btn btn-primary btn-xs">View All</button>--></a>
													<table class="table mb-0">
														<thead>
															<tr>
																<th>Subject Code</th>
																<th>Description</th>
																<th>Instructor</th>
																<th style="text-align:center">Grades</th>
															</tr>
														</thead>
														<tbody>
														

														<?php
														  $i=1;
														  foreach($data3 as $row)
														  {
														  echo "<tr>";
														  echo "<td>".$row->SubjectCode."</td>";
														  echo "<td>".$row->Description."</td>";
														  echo "<td>".$row->Instructor."</td>";
														  echo "<td style='text-align:center'>".$row->Final."</td>";
													   
														  echo "</tr>";
														   
															}
														   ?>
													</tbody>
													   
													</table>
													
                                                </div>

                                                <!-- account history -->
                                                <div id="accounthistory" class="tab-pane">
                                                    <h4 class="mt-1 font-18 ellipsis">Account History</h4>
													<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
													<tr>
														<th style="text-align: center">Semester, SY</th>
														<th style="text-align: center">Total Account</th>
														<th style="text-align: center">Discount</th>
														<th style="text-align: center">Total Payments</th>
														<th style="text-align: center">Balance</th>
													</tr>
												 <?php
													  foreach($data4 as $row)
													  {
													  echo "<tr>";
													  echo "<td style='text-align: center'>".$row->Semester."</td>";
													  echo "<td style='text-align: center'>".$row->AcctTotal."</td>";
													  echo "<td style='text-align: center'>". number_format($row->Discount,2)."</td>";
													  ?>
															<td style="text-align: center"><a href="studepayments?studentno=<?php echo $row->StudentNumber; ?>&sy=<?php echo $row->SY; ?>&sem=<?php echo $row->Sem; ?>"><button type="button" class="btn btn-primary"><?php echo $row->TotalPayments; ?></button></a></td>
													<?php
														 echo "<td style='text-align: center'>".$row->CurrentBalance."</td>";				
													 echo "</tr>";
													  }
													   ?>
														</table>	
														</div>

<!-- other payment history -->
<div id="payments" class="tab-pane">
                                                    <h4 class="mt-1 font-18 ellipsis">Payment History: Services</h4>
													<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
													<tr>
														<th style="text-align: center">Date</th>
														<th style="text-align: center">Amount Paid</th>
														<th style="text-align: center">O.R. NO.</th>
														<th style="text-align: center">Description</th>
													</tr>
												 <?php
													  foreach($data6 as $row)
													  {
													  echo "<tr>";
													  echo "<td style='text-align: center'>".$row->PDate."</td>";
													  echo "<td style='text-align: center'>".$row->Amount."</td>";
													  echo "<td style='text-align: center'>".$row->ORNumber."</td>";
													 echo "<td style='text-align: center'>".$row->description."</td>";				
													 echo "</tr>";
													  }
													   ?>
														</table>	
														</div>


                                                        <!-- profile -->
                                                <div id="enrollmenthistory" class="tab-pane">
                                                    <h4 class="mt-1 font-18 ellipsis">Enrollment History</h4>
													<table class="table mb-0">
													<thead>
														<tr>
															<th>Semester/SY</th>
															<th>Course</th>
															<th>Year Level</th>
															
														</tr>
													</thead>
													<tbody>
													

													<?php
													  $i=1;
													  foreach($data5 as $row)
													  {
													  echo "<tr>";
													  echo "<td>".$row->Semester.', SY '.$row->SY."</td>";
													  echo "<td>".$row->Course."</td>";
													  echo "<td>".$row->YearLevel."</td>";
												   
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
                            <!-- end page title -->

                        </div>
                        <!-- end row -->

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

        <!-- Responsive examples -->
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.js"></script>

        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url(); ?>assets/libs/datatables/dataTables.select.min.js"></script>

        <!-- Datatables init -->
        <script src="<?= base_url(); ?>assets/js/pages/datatables.init.js"></script>
		
    </body>
</html>