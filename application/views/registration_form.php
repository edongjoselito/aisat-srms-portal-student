<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>SRMS | Online Registration</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		
		<!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

		<script type="text/javascript">
		function submitBday() {
		   
			var Bdate = document.getElementById('bday').value;
			var Bday = +new Date(Bdate);
			Q4A= ~~ ((Date.now() - Bday) / (31557600000));
			var theBday = document.getElementById('resultBday');
			theBday.value = Q4A;
		}

		</script>
    </head>
    <body data-layout="horizontal">

				<!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
					<div class="col-md-12">
						<div class="card">
						<img src="<?= base_url(); ?>assets/images/header.png" width="100%" class="img-responsive"> <br />
				<form method="post">
					<div class="col-lg-12">
						<h1><?php echo $this->session->flashdata('msg'); ?></h1>
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>Semester<span style="color:red;">*</span></label>
								<select class="form-control" name="semester"  required>
								<option></option>
								<option>1st Sem.</option>
								<option>2nd Sem.</option>
								<option>Summer</option>
							</select>
							</div>
							<div class="col-sm-3 form-group">
								<label>SY<span style="color:red;">*</span></label>
								<input type="text" name="sy" placeholder="2020-2021" class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>First Name <span style="color:red;">*</span></label>
								<input type="text" placeholder="" class="form-control" name="fname" style="text-transform: uppercase;">
							</div>	
							<div class="col-sm-3 form-group">
								<label>Middle Name<span style="color:red;">*</span></label>
								<input type="text" placeholder="" class="form-control" name="mname" style="text-transform: uppercase;">
							</div>	
							<div class="col-sm-3 form-group">
								<label>Last Name <span style="color:red;">*</span></label>
								<input type="text" placeholder="" class="form-control" name="lname" style="text-transform: uppercase;">
							</div>
							<div class="col-sm-3 form-group">
								<label>Name Extn.</label>
								<input type="text" placeholder="e.g. Jr., Sr." class="form-control" name="nameExtn" style="text-transform: uppercase;">
							</div>							
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>Sex<span style="color:red;">*</span></label>
								<select class="form-control" name="sex"  required>
								<option></option>
								<option>Female</option>
								<option>Male</option>
							</select>
							</div>


							<div class="col-sm-2 form-group">
								<label>Birth Date<span style="color:red;">*</span></label>
								<input type="date" placeholder="" class="form-control" name="bdate" id="bday" onchange="submitBday()" required>
							</div>
							<div class="col-sm-1 form-group">
								<label>Age<span style="color:red;">*</span></label>
								<input type="text" placeholder="" class="form-control" name="age" id="resultBday" required>
							</div>								
							<div class="col-sm-3 form-group">
								<label>Civil Status <span style="color:red;">*</span></label>
								<select name="CivilStatus" class="form-control">
									<option value=""></option>
									<option value="Single">Single</option>
									<option value="Married">Married</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<label>Spouse (if married) </label>
								<input type="text" placeholder="" class="form-control" name="Religion" >
							</div>	
						</div>
						<div class="row">
	
							<div class="col-sm-3 form-group">
								<label>Mobile No.<span style="color:red;">*</span></label>
								<input type="text" placeholder="" class="form-control" name="MobileNumber" required >
							</div>	
							
							<div class="col-sm-3 form-group">
								<label>Ethnicity </label>
								<input type="text" placeholder="" class="form-control" name="Ethnicity" >
							</div>	
							<div class="col-sm-3 form-group">
								<label>Religion </label>
								<input type="text" placeholder="" class="form-control" name="Religion"  >
							</div>	
							<div class="col-sm-3 form-group">
								<label>Working Student<span style="color:red;">*</span></label>
								<select class="form-control" name="working"  required>
								<option></option>
								<option>Yes</option>
								<option>No</option>
							</select>
							</div>							
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Father</label>
								<input type="text" placeholder="" class="form-control" name="Father" >
							</div>


							<div class="col-sm-4 form-group">
								<label>Occupation</label>
								<input type="text" placeholder="" class="form-control" name="FOccupation" >
							</div>
							<div class="col-sm-4 form-group">
								<label>Contact No.</label>
								<input type="text" placeholder="" class="form-control" name="fatherContact" >
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Mother</label>
								<input type="text" placeholder="" class="form-control" name="Mother" >
							</div>


							<div class="col-sm-4 form-group">
								<label>Occupation</label>
								<input type="text" placeholder="" class="form-control" name="MOccupation" >
							</div>
							<div class="col-sm-4 form-group">
								<label>Contact No.</label>
								<input type="text" placeholder="" class="form-control" name="motherContact" >
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>Guardian</label>
								<input type="text" placeholder="" class="form-control" name="Guardian" >
							</div>


							<div class="col-sm-4 form-group">
								<label>Relationship</label>
								<input type="text" placeholder="" class="form-control" name="GuardianRelationship" >
							</div>
							<div class="col-sm-4 form-group">
								<label>Guardian Contact No.</label>
								<input type="text" placeholder="" class="form-control" name="GuardianContact" >
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-4 form-group">
								<label>E-mail Address<span style="color:red;">*</span></label>
								<input type="email" placeholder="" class="form-control" name="email" required>
							</div>
							<div class="col-sm-4 form-group">
								<label>Username <span style="color:red;">*this will serve as your temporary Student No.</span></label>
								<input type="text" placeholder="" class="form-control" name="lrn" required>
							</div>


							<div class="col-sm-4 form-group">
								<label>Password <span style="color:red;">*</span></label>
								<input type="password" placeholder="" class="form-control" name="pass" required>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
							<input type="submit" name="register" class="btn btn-lg btn-info" value="Create My Account">					
							</div>
						</div>
					</form> 
					</div>
				
				</div>
				</div>
				</div>
			</div>

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>