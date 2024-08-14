<?php include('includes/connections.php'); ?>
<?php include('includes/functions.php'); ?>
<!DOCTYPE>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="style-print.css" media="print" />
<title>PROSPECTUS</title>
</head>

<body>

<div id="wrapper">

   <div id="header">
	   <img src="assets/images/header.png" />
    </div> <!-- end #header -->
	 <div class="blocker"></div>
    <div class="prospectus">

    <?php if(isset($_POST['submit'])){
         $sn = prep($_POST['student_name']);
         $course = prep($_POST['course']);
       } else { 
         $sn = '';
         $course = '2 Years in Hotel and Restaurant Management';
       }

     ?>


     <form class="prospectus-form" action="prospectus.php" method="post">
       <input type="text" name="student_name" value="" />
       <select name="course">
         <?php
           $course_set = find_2_course();
           while($courses = mysqli_fetch_assoc($course_set)){
             $c = $courses['CourseDescription'];
             echo '<option';
             if($courses['CourseDescription'] == $course){
               echo ' selected';
             }
             echo '>'.$c.'</option>';
             }
         ?>

       </select>
       <input type="submit" value="Submit" name="submit" />
     </form>
     

    <?php
      $table_header = "<tr>
          <th>GRADE</th>
          <th>COURSE CODE</th>
          <th>COURSE TITLE</th>
          <th>LEC UNIT</th>
          <th>LAB UNIT</th>
          <th>TOTAL</th>
          <th>PREREQUISITE</th>
        </tr>";
        

     ?>
     
     <div class="print-heading">
      <!--- <h1>JOJI ILAGAN CAREER CENTER FOUNDATION, INC.</h1>
       <p>Davao City<br />
       Tel/Fax No.:(087) 811-1184 | (087) 306-0062<br />
       <span>www.candortci.edu.ph | info@candortci.edu.ph</span>
       </p> -->
       <h2>Evaluation Form</h2>
     </div>
     
     <div class="labels">
      <p><span>Student No. </span>: <?php echo $sn?></p>
      <?php $student = find_student_by_id($sn); ?>
      <p><span>Student Name. </span>: <?php if($sn == ''){echo '';}else{echo $student['LastName']. ', '. $student['FirstName'];}?></p>
      <p><span>Course </span>: <?php if($sn == ''){echo '';}else{echo $course;} ?></p>
    </div>

      <h1 class="prospectus-heading pros1st">FIRST YEAR: 1ST SEMESTER</h1>
      <table class="prospectus-table" border="0" cellpadding="0" cellspacing="0">
        <?php
          echo $table_header;
          $subject_set = find_subject_by_yearlevel_semester_course('1st', '1st Sem.', $course);
          while($subject = mysqli_fetch_assoc($subject_set)){ 
          
          ?>

        <tr>
          <td>
          <?php
            $sd = $subject['description'];
            $grade = find_grade_by_subject_description($sn, $sd);
          ?>
            <span <?php color_state(); ?> >
		  <?php
	            echo $grade['Equivalent'];
	            
	          ?>
            </span>
          </td>
          <td><span <?php color_state(); ?> ><?php echo $subject['SubjectCode']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['description']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']+$subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['prereq']; ?></span></td>
        </tr>
        <?php } mysqli_free_result($subject_set); ?>
      </table>
      

       <?php //first year 2nd sem ?>
      
      <h1 class="prospectus-heading">FIRST YEAR: 2ND SEMESTER</h1>
      <table class="prospectus-table" border="0" cellpadding="0" cellspacing="0">

        <?php
          echo $table_header;
          $subject_set = find_subject_by_yearlevel_semester_course('1st', '2nd Sem.', $course);
          while($subject = mysqli_fetch_assoc($subject_set)){ ?>

        <tr>
          <td>
          <?php
            $sd = $subject['description'];
            $grade = find_grade_by_subject_description($sn, $sd);
          ?>
            <span <?php color_state(); ?> >
		  <?php
	            echo $grade['Equivalent'];
	          ?>
            </span>
          </td>
          <td><span <?php color_state(); ?> ><?php echo $subject['SubjectCode']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['description']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']+$subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['prereq']; ?></span></td>
        </tr>
        <?php } mysqli_free_result($subject_set); ?>
      </table>
      
      <?php //SUMMER  
        $subject_set = find_subject_by_yearlevel_semester_course('1st', 'Summer', $course);
        if(mysqli_num_rows($subject_set)){
      ?>
      

      <h1 class="prospectus-heading">1ST YEAR: SUMMER</h1>
      <table class="prospectus-table" border="0" cellpadding="0" cellspacing="0">

        <?php
          echo $table_header;
          while($subject = mysqli_fetch_assoc($subject_set)){ ?>

        <tr>
          <td>
          <?php
            $sd = $subject['description'];
            $grade = find_grade_by_subject_description($sn, $sd);
          ?>
            <span <?php color_state(); ?> >
		  <?php
	            echo $grade['Equivalent'];
	          ?>
            </span>
          </td>
          <td><span <?php color_state(); ?> ><?php echo $subject['SubjectCode']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['description']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']+$subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['prereq']; ?></span></td>
        </tr>
        <?php } mysqli_free_result($subject_set); ?>
      </table>
      
      <?php } //second year 1st sem ?>
      
      <h1 class="prospectus-heading">SECOND YEAR: 1ST SEMESTER</h1>
      <table class="prospectus-table" border="0" cellpadding="0" cellspacing="0">

        <?php
          echo $table_header;
          $subject_set = find_subject_by_yearlevel_semester_course('2nd', '1st Sem.', $course);
          while($subject = mysqli_fetch_assoc($subject_set)){ ?>
        <tr>
          <td>
          <?php
            $sd = $subject['description'];
            $grade = find_grade_by_subject_description($sn, $sd);
          ?>
            <span <?php color_state(); ?> >
		  <?php
	            echo $grade['Equivalent'];
	          ?>
            </span>
          </td>
          <td><span <?php color_state(); ?> ><?php echo $subject['SubjectCode']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['description']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']+$subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['prereq']; ?></span></td>
        </tr>
        <?php } mysqli_free_result($subject_set); ?>
      </table>
      
      <?php //second year 2nd sem ?>
      
      <h1 class="prospectus-heading">SECOND YEAR: 2ND SEMESTER</h1>
      <table class="prospectus-table" border="0" cellpadding="0" cellspacing="0">

        <?php
          echo $table_header;
          $subject_set = find_subject_by_yearlevel_semester_course('2nd', '2nd Sem.', $course);
          while($subject = mysqli_fetch_assoc($subject_set)){ ?>

        <tr>
          <td>
          <?php
            $sd = $subject['description'];
            $grade = find_grade_by_subject_description($sn, $sd);
          ?>
            <span <?php color_state(); ?> >
		  <?php
	            echo $grade['Equivalent'];
	          ?>
            </span>
          </td>
          <td><span <?php color_state(); ?> ><?php echo $subject['SubjectCode']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['description']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['lecunit']+$subject['labunit']; ?></span></td>
          <td><span <?php color_state(); ?> ><?php echo $subject['prereq']; ?></span></td>
        </tr>
        <?php } mysqli_free_result($subject_set); ?>
      </table>


      
                       

    </div>



   <div class="blocker"></div>
<?php include('includes/footer.php'); ?>

</div> <!-- End #wrapper -->
	</body>

</html>