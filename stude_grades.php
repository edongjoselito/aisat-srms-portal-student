<?php include('includes/connections.php'); ?>
<?php include('includes/functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Online SRMS | </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
			 <div class="col-lg-12">
				
			 <div class="card card-">
              <div class="card-header">
			  	<?php
				$result = mysqli_query($con, "SELECT * FROM studeprofile where StudentNumber='$_GET[view]'");
				$row=mysqli_fetch_array($result);
				?>
                <h3 class="card-title p-3 my-3 bg-primary text-white"><b><?php echo $row['FirstName'].' '.$row['MiddleName'].' '.$row['LastName']; ?></b></h3>
              </div>
                        <section class="content">
					       <div class="row">
					           <?php $result_set = find_report_of_grade($_GET['view']); ?>
							   <div class="box-body table-responsive">
									  <?php if(mysqli_num_rows($result_set)){ $sem_sy = ""; ?>

									  <table class="table">
										<tr>
										  <th>Sem./SY</th>
										  <th>Subject Code</th>
										  <th>Description</th>
										  <th style="text-align: center">Grades</th>
										 <!-- <th style="text-align: center">Remarks</th>-->
										</tr>

										<?php while($row = mysqli_fetch_assoc($result_set)){?>
										<tr>
										  <td><?php if($sem_sy!=$row['Semester'].', '.$row['SY']) echo htmlentities($row['Semester'].', '.$row['SY']); ?></td>
										  <td><?php echo htmlentities($row['SubjectCode']); ?></td>
										  <td><?php echo htmlentities($row['Description']); ?></td>									  
										  <td style="text-align: center"><?php echo $row['Final'];  
												if($row['Final']<=3.5) {
											$remarks='Passed';
												} else {
											$remarks='Failed';
											}
										?></td>
									<!--	<td style="text-align: center"><?php echo $remarks; ?></td> -->
										</tr>
										<?php
										$sem_sy = $row['Semester'].', '.$row['SY'];
										} mysqli_free_result($result_set); ?>
									  </table>

									  <?php } else {
									  echo "<div class=\"block\"></div>";
									  echo "<h1 class=\"noRecordFound\">No records found.</h1>";
									  }?>
									
								</div>
								
						</div>
					</div>
					</div>
					</div>
		</div>

</div>
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
</body>
</html>
