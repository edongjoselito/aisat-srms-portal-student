<?php
class Page extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
	$this->load->helper('url', 'form');	
	$this->load->library('form_validation');
    $this->load->model('StudentModel');
	$this->load->model('SettingsModel');
	$this->load->model('PersonnelModel');
	$this->load->model('InstructorModel');
	
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  function index(){
    //Allowing access to admin only
      if($this->session->userdata('level')==='Admin'){
      
	  $this->load->view('dashboard_admin');
      }else{
          echo "Access Denied";
      }
   }

  
  
       function proof_payment(){
    //Allowing access to Stuent only
    if($this->session->userdata('level')==='Student'){
		$id=$this->session->userdata('username');
		$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$result1['data1']=$this->StudentModel->UploadedPayments($id,$sem,$sy);
		$result1['data']=$this->StudentModel->getSemesterfromOE($id);
		$this->load->view('upload_payments',$result1);
	  
	 //$this->load->view('upload_payments');
    }else{
        echo "Access Denied";
    }
	}
	    function proof_payment_view(){
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		$result1['data1']=$this->StudentModel->UploadedPaymentsAdmin($sem, $sy);
		$result1['data4']=$this->StudentModel->forPaymentVerCount($sy,$sem);
		$this->load->view('proof_payments',$result1);
	}
	    function onlinePaymentsAll(){
		$result1['data1']=$this->StudentModel->onlinePaymentsAll();
		$this->load->view('onlinePaymentsAll',$result1);
	}
	
  
  function student(){
    //Allowing access to Stuent only
    if($this->session->userdata('level')==='Student'){
      $id=$this->session->userdata('username');
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		
	  $result['data']=$this->StudentModel->announcement();
	  $result['data1']=$this->StudentModel->studeEnrollStat($id, $sem, $sy);
	  //$result['data2']=$this->StudentModel->studeBalance($id, $sem, $sy);
	   $result['data2']=$this->StudentModel->studeBalance($id);
	  $result['data3']=$this->StudentModel->semStudeCount($id);
	  $result['data4']=$this->StudentModel->studeTotalSubjects($id, $sem, $sy);
	  
	  $this->load->view('dashboard_student',$result);
    }else{
        echo "Access Denied";
    }
  }
  
  function studeEnrollHistory(){
	  $id=$this->session->userdata('username');
	  $result['data']=$this->StudentModel->admissionHistory($id);
	  $this->load->view('stude_enroll_history',$result);
  }
  
   //stude account - Student Access
  function studeaccount(){
	  if($this->session->userdata('level')==='Student'){
		    $id=$this->session->userdata('username');
			  $result['data']=$this->StudentModel->studeaccountById($id);
			  $this->load->view('account_tracking',$result);
	  }
	  else{
		  $id=$this->input->get('id');
		  $result['data']=$this->StudentModel->studeaccountById($id);
		  $this->load->view('account_tracking',$result);
}}

  //stude account - Admin Access
  function studeaccountAdmin(){
  $id=$this->input->get('id');
  $result['data']=$this->StudentModel->studeaccountById($id);
  $this->load->view('account_tracking_admin',$result);
  }
  
  function studepayments(){
  $studentno=$this->input->get('studentno');
  $sem=$this->input->get('sem');
  $sy=$this->input->get('sy');
  $result['data']=$this->StudentModel->studepayments($studentno,$sem,$sy);
  $this->load->view('stude_payments',$result);
  }
  
 
		
  function getOR()
	{
	$query=$this->db->query("select * from paymentsaccounts order by ID desc limit 1");
	return $query->result();
	}

	function UploadedPayments($id)
	{
	$query=$this->db->query("select * from online_payments where StudentNumber='".$id."'");
	return $query->result();
	}

	function UploadedPaymentsAdmin($id)
	{
	$query=$this->db->query("select * from online_payments op join studeprofile p on op.StudentNumber=p.StudentNumber where p.StudentNumber='".$id."' and op.depositStat='For Verification'");
	return $query->result();
	}
	
  function studegrades(){
  $this->load->view('student_grades');
  }

  function bdayToday(){
	$sy=$this->session->userdata('sy');
	$sem=$this->session->userdata('semester');
	$result['data']=$this->StudentModel->birthdayCelebs($sem,$sy);
	$this->load->view('bday_today',$result);
  }
  
   //Masterlist by Sex
		function listBySex(){
		$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$sex=$this->input->get('sex');	
		$result['data']=$this->StudentModel->sexList($sem,$sy,$sex);
		$this->load->view('masterlist_by_sex',$result);
		}
   function bdayMonth(){
	$sy=$this->session->userdata('sy');
	$sem=$this->session->userdata('semester');
	$result['data']=$this->StudentModel->birthdayMonths($sem,$sy);
	$this->load->view('bday_months',$result);
  } 
 //online enrollment
  function enrollment(){
	  $id=$this->session->userdata('username');
	  
 		$courseVal = $this->input->post('course'); 
        $yearlevelVal = $this->input->post('yearlevel'); 
        $result['data']=$this->StudentModel->displayrecordsById($id);
        //$result['data']=$this->StudentModel->getFilteredEnrollees($courseVal,$yearlevelVal); 
        $result['course']=$this->StudentModel->getCourse();
        $result['courseVal'] = $courseVal;
        $result['yearlevelVal'] = $yearlevelVal;
 		$this->load->view('enrollment_form',$result);


	if($this->input->post('enroll'))
		{
		//get data from the form
		$StudentNumber=$this->input->post('StudentNumber');
		$FName=$this->input->post('FName');
		$MName=$this->input->post('MName');	 
		$LName=$this->input->post('LName');
		$Course=$this->input->post('Course');
		$Major=$this->input->post('Major');
		$YearLevel=$this->input->post('YearLevel');
		$Semester=$this->input->post('Semester');
		$SY=$this->input->post('SY');
		$requirements=$this->input->post('requirements');
		
		$fname=$this->session->userdata('fname');
		$email=$this->session->userdata('email');
		
		//check if record exist
		$que=$this->db->query("select * from online_enrollment where StudentNumber='".$StudentNumber."' and Semester='".$Semester."' and SY='".$SY."'");
		$row = $que->num_rows();
		if($row)
		{
		$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>You are currently enrolled for this semester.</b></div>');
		//$this->load->view('enrollment_form');
		redirect('Page/enrollment');
		}
		else
		{
		$que=$this->db->query("insert into online_enrollment values('','$StudentNumber','$FName','$MName','$LName','$Course','$Major','$YearLevel','$Semester','$SY','$requirements','For Validation','0','Unpaid')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Your data has been submitted successfully for validation.</b></div>');
		
		 //Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $fname . ',' . "\r\n"; 
			$mail_message .= '<br><br>Your enrollment data has been submitted for validation.' . "\r\n"; 
			$mail_message .= '<br>Course: <b>' . $Course . '</b>' ."\r\n";
			$mail_message .= '<br>Major: <b>' . $Major . '</b>'."\r\n";
			$mail_message .= '<br>Year Level: <b>' . $YearLevel . '</b>'."\r\n";
			$mail_message .= '<br>Sem/SY: <b>' . $Semester . ', '. $SY .'</b>'."\r\n";
			$mail_message .= '<br>Status: <b>For Validation</b>'."\r\n";
			
			$mail_message .= '<br><br>You will be notified once validated.' ."\r\n";
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Enrollment')
				->message($mail_message);
				$this->email->send();
				
		redirect('Page/enrollment');
		}			
		} 
  }
  
  //final processing of enrollment
   function enrollmentAcceptance(){
        $courseVal = $this->input->post('course'); 
        $yearlevelVal = $this->input->post('yearlevel'); 
        $result['course']=$this->StudentModel->getCourse();
		$result['section']=$this->StudentModel->getSection();
		//$result['strand']=$this->SettingsModel->getTrack();
        $result['courseVal'] = $courseVal;
        $result['yearlevelVal'] = $yearlevelVal;
       	$this->load->view('enrollment_form_final',$result);
	if($this->input->post('submit'))
		{
		//get data from the form
		$email=$this->input->get('email');
		$StudentNumber=$this->input->post('StudentNumber');
		$FName=$this->input->post('FName');
		$MName=$this->input->post('MName');	 
		$LName=$this->input->post('LName');
		$Course=$this->input->post('Course');
		$YearLevel=$this->input->post('YearLevel');
		$Status=$this->input->post('Status');
		$Semester=$this->input->post('Semester');
		$SY=$this->input->post('SY');
		$Section=$this->input->post('Section');
		
		$StudeStatus=$this->input->post('StudeStatus');
		$YearLevelStat=$this->input->post('YearLevelStat');
		$Major=$this->input->post('Major');
		
		$EnrolledDate=date("Y-m-d");
		//check if record exist
		$que=$this->db->query("select * from semesterstude where StudentNumber='".$StudentNumber."' and Semester='".$Semester."' and SY='".$SY."'");
		$row = $que->num_rows();
		if($row)
		{

        //$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>The selected student is currently enrolled for this semester!</b></div>');
		//redirect('Page/enrollmentAcceptance
		$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>The selected student is currently enrolled!</b></div>');
		 redirect('Masterlist/enrolledList');
		}
		else
		{
		//save enrollment
		$que=$this->db->query("insert into semesterstude values('','$StudentNumber','$FName','$MName','$LName','$Course','$YearLevel','Enrolled','$Semester','$SY','Term','$Section','$StudeStatus','','','','','','','0','$YearLevelStat','$Major','1','$EnrolledDate','','','','','','','')");
		$que1=$this->db->query("update online_enrollment set enrolStatus='Enrolled' where StudentNumber='$StudentNumber' and Semester='$Semester' and SY='$SY'");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Your registration details have been processed successfully. </b></div>');
        
		
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FName . ',' . "\r\n"; 
			$mail_message .= '<br><br>You are now officially enrolled.' . "\r\n"; 
			$mail_message .= '<br>Course: <b>' . $Course . '</b>' ."\r\n";
			$mail_message .= '<br>Major: <b>' . $Major . '</b>'."\r\n";
			$mail_message .= '<br>Year Level: <b>' . $YearLevel . '</b>'."\r\n";
			$mail_message .= '<br>Section: <b>' . $Section . '</b>'."\r\n";
			$mail_message .= '<br>Sem/SY: <b>' . $Semester . ', '. $SY .'</b>'."\r\n";
			$mail_message .= '<br>Status: <b>Validated</b>'."\r\n";

			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Enrollment')
				->message($mail_message);
				$this->email->send();
				
		redirect('Masterlist/enrolledList');
		}			
		} 
  }
  
 
  //update online enrollees
  public function update_online_enrollees()
  {
  $id=$this->input->get('id');
  $this->StudentModel->updateEnrollees($id);
  redirect("Page/admin");
  }

	function studentsprofile(){
		if($this->session->userdata('level')==='Student'){
		    $id=$this->session->userdata('username');
			$studeno=$this->session->userdata('username');
			$sy = $this->session->userdata('sy');
			$sem = $this->session->userdata('semester');
			$result['data']=$this->StudentModel->displayrecordsById($id);  
			$result['data1']=$this->StudentModel->profilepic($id);	
			$result['data2']=$this->StudentModel->requirements($id);
			$result['data3']=$this->StudentModel->studeGrades($studeno, $sem, $sy);
			$result['data4']=$this->StudentModel->studeaccountById($id);
			$result['data6']=$this->StudentModel->otherPaymentHistory($id);
			$result['data5']=$this->StudentModel->admissionHistory($id);		
			$this->load->view('profile_page',$result);
	  }
	  else{  
	$id=$this->input->get('id');
			$studeno=$this->input->get('id');
			$sy = $this->session->userdata('sy');
			$sem = $this->session->userdata('semester');
			$result['data']=$this->StudentModel->displayrecordsById($id);  
			$result['data1']=$this->StudentModel->profilepic($id);	
			$result['data2']=$this->StudentModel->requirements($id);
			$result['data3']=$this->StudentModel->studeGrades($studeno, $sem, $sy);
			$result['data4']=$this->StudentModel->studeaccountById($id);
			$result['data5']=$this->StudentModel->admissionHistory($id);		
			$this->load->view('profile_page',$result);
	  }} 
 	
	//Staff Profile
	function staffprofile(){
		 if($this->session->userdata('level')==='Admin'){
		 $id=$this->input->get('id');}
		 elseif($this->session->userdata('level')==='HR Admin'){
		 $id=$this->input->get('id');}
		 
		 else{
		 $id=$this->session->userdata('IDNumber');}
					
			$result['data']=$this->StudentModel->staffProfile($id); 
			$result['data1']=$this->StudentModel->profilepic($id);	
			$result['data2']=$this->PersonnelModel->family($id);
			$result['data3']=$this->PersonnelModel->education($id);	
			$result['data4']=$this->PersonnelModel->cs($id);
			$result['data5']=$this->PersonnelModel->trainings($id);
			$result['data6']=$this->PersonnelModel->viewfiles($id);
			$this->load->view('profile_page_staff',$result);
	  }
	  
      function notification_error(){
  $this->load->view('notification_error');
  }
  
  function uploadrequirements()
  {
	  	$id=$this->session->userdata('username');
		$result['data']=$this->StudentModel->requirements($id);
		$this->load->view('upload_requirements',$result);	
  }
  
 public function upload() 
	{
		$config['upload_path'] = './upload/requirements/';
        $config['allowed_types'] = 'pdf|jpeg|jpg|png';
        $config['max_size'] = 5120;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('nonoy')) 
		{
            $msg = array('error' => $this->upload->display_errors());

            $this->load->view('uploadrequirements', $msg);
        } 
		else 
		{
            $data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$StudentNumber=$this->input->post('StudentNumber');
			$email=$this->session->userdata('email');
			$FName=$this->session->userdata('fname');
			
			$filename = $this->upload->data('file_name');
			$docName=$this->input->post('docName');
			$date=date("Y-m-d");
			$que=$this->db->query("insert into online_requirements values('','$StudentNumber','$filename','$date','$docName')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');
			
			//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FName . ',' . "\r\n"; 
			$mail_message .= '<br><br>Thank you for submitting/uploading your requirements.' . "\r\n"; 
			
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Enrollment')
				->message($mail_message);
				$this->email->send();
			
			redirect('Page/uploadrequirements');

		}
    }
	
	 public function uploadPayments() 
  {
		$config['upload_path'] = './upload/payments';
      $config['allowed_types'] = 'pdf|jpeg|jpg|png';
        $config['max_size'] = 5120;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('nonoy')) 
    {
            $msg = array('error' => $this->upload->display_errors());

            $this->load->view('upload_payments', $msg);
        } 
    else 
    {
      $data = array('image_metadata' => $this->upload->data());
      $StudentNumber=$this->input->post('StudentNumber');
      $filename = $this->upload->data('file_name');
      $amountPaid=$this->input->post('amountPaid');
      $depositStat=$this->input->post('depositStat');
	    $sem=$this->input->post('sem');
	    $sy=$this->input->post('sy');
	    $date=date("Y-m-d");
      $payment_for=$this->input->post('payment_for');
      $note=$this->input->post('note');
	  
      $que=$this->db->query("insert into online_payments values('','$StudentNumber','$filename','$amountPaid','$depositStat','$sem','$sy','$date','$payment_for','$note')");
      
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');
      //$this->load->view('upload_payments');
	  
		$id=$this->input->post('StudentNumber');
		$fname=$this->session->userdata('fname');
		$email=$this->session->userdata('email');
		
		$result1['data1']=$this->StudentModel->UploadedPayments($id, $sem, $sy);
		$result1['data']=$this->StudentModel->getSemesterfromOE($id);
		$this->load->view('upload_payments',$result1);
		
		//Email Notification
		//	$this->load->config('email');
		//	$this->load->library('email');
		//	$mail_message = 'Dear ' . $fname . ',' . "\r\n"; 
		//	$mail_message .= '<br><br>Thank you for the payment you made with the following details:' . "\r\n"; 
		//	$mail_message .= '<br>Amount Paid: <b>' . $amountPaid . '</b>' ."\r\n";
		//	$mail_message .= '<br>Payment For: <b>' . $payment_for . '</b>'."\r\n";
		//	$mail_message .= '<br>Applicable Sem/SY: <b>' . $sem . ', '. $sy .'</b>'."\r\n";
		//	$mail_message .= '<br>Date Uploaded: <b>' . $date . '</b>' . "\r\n";
		//	$mail_message .= '<br>Note: <b>' . $note . '</b>' . "\r\n";
		//	$mail_message .= '<br><br>Your payment has to be manually reviewed. You will be notified once verified.' ."\r\n";
		//	$mail_message .= '<br><br>Thanks & Regards,';
		//	$mail_message .= '<br>SRMS - Online';

		//	$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
		//		->to($email)
		//		->subject('Payment Uploaded')
		//		->message($mail_message);
		//		$this->email->send();
	  }
    }
	
	//Profile List
	 function profileList(){
          $result['data']=$this->StudentModel->getProfile(); 
          $this->load->view('profile_list',$result);
      }
	//Profile List for Enrollment
	 function profileForEnrollment(){
          $result['data']=$this->StudentModel->getProfile(); 
          $this->load->view('profile_list_for_enrollment',$result);
      }
	//Contact Directory
	 function studeDirectory(){
          $result['data']=$this->StudentModel->getProfile(); 
          $this->load->view('contact_directory',$result);
      }

 function fetch_major(){

    if($this->input->post('course')){
        $output = '<option value=""></option>';
        $yearlevel = $this->StudentModel->getMajor($this->input->post('course'));
        foreach($yearlevel as $row){
          $output .= '<option value ="'.$row->Major.'">'.$row->Major.'</option>';
        }
        echo $output;
    }

  }
   function changepassword(){
  $this->load->view('change_pass');
  }

  function update_password(){

		$this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim|callback__validate_currentpassword');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|trim|min_length[8]|alpha_numeric');
		$this->form_validation->set_rules('cnewpassword', 'Confirm New Password', 'required|trim|matches[newpassword]');
		
		$this->form_validation->set_message('required',"Please fill-up the form completely!");
		if($this->form_validation->run()){

      $username=$this->session->userdata('username');
		  $newpass= sha1($this->input->post('newpassword'));
			if($this->StudentModel->reset_userpassword($username, $newpass)){
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Succesfully changed password</div>');
				$this->load->view('change_pass');

        } 
        else{
					echo "Error";
				}	
				
		}else{
			$this->session->set_flashdata('msg','');
			$this->load->view('change_pass');	
		}	
  }

function _validate_currentpassword(){
    $username=$this->session->userdata('username');
		$currentpass= sha1($this->input->post('currentpassword'));
    if($this->StudentModel->is_current_password($username, $currentpass)){
      return TRUE;
    } 
    else {
      $this->form_validation->set_message('_validate_currentpassword', 'Wrong Current Password');
      return FALSE;
    }
    
  }
  
    function acceeptPayment(){
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$result['course']=$this->StudentModel->getCourse();
 	//$result['data']=$this->StudentModel->getOR();
	$result['data4']=$this->StudentModel->forPaymentVerCount($sy,$sem);
 	$this->load->view('payment_form',$result);
	 
	if($this->input->post('submit'))
		{
		//get data from the form
		$email=$this->input->get('email');
		$StudentNumber=$this->input->post('StudentNumber');
		$FirstName=$this->input->post('FirstName');
		$MiddleName=$this->input->post('MiddleName');	 
		$LastName=$this->input->post('LastName');
		$Course=$this->input->post('Course');
		$YearLevel=$this->input->post('YearLevel');
		$ORNumber=$this->input->post('ORNumber');
		$Amount=$this->input->post('Amount');
		$description=$this->input->post('description');
		$opID=$this->input->post('opID');
		$PaymentType=$this->input->post('PaymentType');
		$CheckNumber=$this->input->post('CheckNumber');
		
		$opID=$this->input->post('opID');
		$Bank=$this->input->post('Bank');
		$Sem=$this->input->post('Sem');
		$SY=$this->input->post('SY');
		$Cashier=$this->session->userdata('username');
		$CollectionSource=addslashes("Student's Account");

		$PDate=date("Y-m-d");
		//check if record exist
		$que=$this->db->query("select * from paymentsaccounts where ORNumber='".$ORNumber."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
       $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Duplicate O.R. Number</b></div>');
        redirect('Page/acceeptPayment');
		}
		else
		{
		//save payments
		$que=$this->db->query("insert into paymentsaccounts values('','$StudentNumber','$FirstName','$MiddleName','$LastName','$Course','$PDate','$ORNumber','$Amount','$description','$PaymentType','$CheckNumber','$Sem','$SY','$CollectionSource','','Valid','$Cashier')");
		//update online_enrollment enrolStatus to Verified
		$que1=$this->db->query("update online_enrollment set downPaymentStat='Paid',downPayment='$Amount' where StudentNumber='$StudentNumber' and Semester='$Sem' and SY='$SY'");
		//update online_payments depositStat to Verified
		$que2=$this->db->query("update online_payments set depositStat='Verified' where opID='$opID'");
				
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>The payment details has been processed successfully.</b></div>');
        
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FirstName . ',' . "\r\n"; 
			$mail_message .= '<br><br>The payment you submitted with the following details has been verified.' . "\r\n"; 
			$mail_message .= '<br>Amount Paid: <b>' . $Amount . '</b>' ."\r\n";
			$mail_message .= '<br>Payment For: <b>' . $description . '</b>'."\r\n";
			$mail_message .= '<br>O.R. No.: <b>' . $ORNumber . '</b>' ."\r\n";
			$mail_message .= '<br>Processed Date: <b>' . $PDate . '</b>'."\r\n";
			
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Payment Confirmation')
				->message($mail_message);
				$this->email->send();
		
		redirect('Page/proof_payment_view');
		}			
		} 
 
  }
function profileEntry()
  {
	  $this->load->view('profile_form');
	  if($this->input->post('submit'))
		{
		//get data from the form
		$StudentNumber=$this->input->post('StudentNumber');
		$FirstName=strtoupper($this->input->post('FirstName'));
		$MiddleName=strtoupper($this->input->post('MiddleName'));	 
		$LastName=strtoupper($this->input->post('LastName'));
		$nameExtn=$this->input->post('nameExtn');
		$completeName=$FirstName.' '.$LastName;
		$Religion=$this->input->post('Religion');
		$Sex=$this->input->post('Sex');
		$CivilStatus=$this->input->post('CivilStatus');
		$MobileNumber=$this->input->post('MobileNumber');
		$ethnicity=$this->input->post('ethnicity');
		$BirthDate=$this->input->post('BirthDate');
		$BirthPlace=$this->input->post('BirthPlace');
		//New
		$age=$this->input->post('age');

		//Parents
		$Father=$this->input->post('Father');
		$FOccupation=$this->input->post('FOccupation');
		$Mother=$this->input->post('Mother');
		$MOccupation=$this->input->post('MOccupation');
		//Guardian Info
		$guardian=$this->input->post('guardian');
		$guardianContact=$this->input->post('guardianContact');
		$guardianRelationship=$this->input->post('guardianRelationship');
		$guardianAddress=$this->input->post('guardianAddress');
		//Address
		$sitio=$this->input->post('sitio');
		$brgy=$this->input->post('brgy');
		$city=$this->input->post('city');
		$province=$this->input->post('province');
		$email=$this->input->post('email');
		$working=$this->input->post('working');
		$nationality=$this->input->post('nationality');
		
		$Encoder=$this->session->userdata('username');
		$updatedDate=date("Y-m-d");		

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		
		$AdmissionDate=date("Y-m-d");
		$GraduationDate=date("Y-m-d");
		$Password=sha1($this->input->post('BirthDate'));
		$Encoder=$this->session->userdata('username');
		
		//check if record exist
		$que=$this->db->query("select * from studeprofile where StudentNumber='".$StudentNumber."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Student Number is in use.</b></div>');
        redirect('Page/profileList');
		}
		else
		{
		//save profile
		$que=$this->db->query("insert into studeprofile values('$StudentNumber','$FirstName','$MiddleName','$LastName','$Sex','$CivilStatus','$BirthPlace','$Religion','$email','$MobileNumber','$working','','','','','$BirthDate','$AdmissionDate','$GraduationDate','$guardian','$guardianRelationship','$guardianContact','$guardianAddress','','','','','','','','','$father','$fOccupation','','$mother','$mOccupation','','','','$age','','','','','','$ethnicity','$fourPs','','','','','$province','$city','$brgy','$province','$city','$brgy','$sitio','','','','','','','','','','','','','','','','','','','','1','','','$AdmissionDate','$Encoder','','','','','','','','','','','$nameExtn','','','$nationality')");
		$que=$this->db->query("insert into users values('$StudentNumber','$Password','Student','$FirstName','$MiddleName','$LastName','email','avatar.png','Active','$AdmissionDate','$completeName','$StudentNumber')");
		$que=$this->db->query("insert into profimage values('','','$StudentNumber')");
		$que=$this->db->query("insert into atrail values('','Created Student''s Profile and User Account','$AdmissionDate','$now','$Encoder','$StudentNumber')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Profile has been saved successfully.</b></div>');
        
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FirstName . ',' . "\r\n"; 
			$mail_message .= '<br><br>Your profile is now encoded to SRMS. Please take note of the following:' . "\r\n"; 
			$mail_message .= '<br>Username: <b>' . $StudentNumber . '</b>' ."\r\n";
			$mail_message .= '<br>Password: <b>' . $BirthDate . '</b>'."\r\n";
			
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Account Created')
				->message($mail_message);
				$this->email->send();	
		
		redirect('Page/profileList');
		}			
		} 
  }
 function personnelEntry()
  {
	  $this->load->view('hr_personnel_profile_form');
	  if($this->input->post('submit'))
		{
		//get data from the form
		$prefix=$this->input->post('prefix');
		$IDNumber=$this->input->post('IDNumber');
		$FirstName=strtoupper($this->input->post('FirstName'));
		$MiddleName=strtoupper($this->input->post('MiddleName'));	 
		$LastName=strtoupper($this->input->post('LastName'));
		$NameExtn=$this->input->post('NameExtn');
		$completeName=$FirstName.' '.$LastName;
		$Sex=$this->input->post('Sex');
		$BirthDate=$this->input->post('BirthDate');
		$age=$this->input->post('age');
		$BirthPlace=$this->input->post('BirthPlace');
		$MaritalStatus=$this->input->post('MaritalStatus');
		$height=$this->input->post('height');
		$weight=$this->input->post('weight');
		$bloodType=$this->input->post('bloodType');
		$empTelNo=$this->input->post('empTelNo');
		$empMobile=$this->input->post('empMobile');
		$empEmail=$this->input->post('empEmail');
		$fb=$this->input->post('fb');
		$skype=$this->input->post('skype');
		$citizenship=$this->input->post('citizenship');
		$dualCitizenship=$this->input->post('dualCitizenship');
		$citizenshipType=$this->input->post('citizenshipType');
		$citizenshipCountry=$this->input->post('citizenshipCountry');
		$empPosition=$this->input->post('empPosition');
		$Department=$this->input->post('Department');
		$empStatus=$this->input->post('empStatus');
		$agencyCode=$this->input->post('agencyCode');
		$dateHired=$this->input->post('dateHired');
		$retYear=$this->input->post('retYear');
		$gsis=$this->input->post('gsis');
		$pagibig=$this->input->post('pagibig');
		$philHealth=$this->input->post('philHealth');
		$sssNo=$this->input->post('sssNo');
		$tinNo=$this->input->post('tinNo');
		$contactName=$this->input->post('contactName');
		$contactRel=$this->input->post('contactRel');
		$contactEmail=$this->input->post('contactEmail');
		$contactNo=$this->input->post('contactNo');
		$contactAddress=$this->input->post('contactAddress');
		$resHouseNo=$this->input->post('resHouseNo');
		$resStreet=$this->input->post('resStreet');
		$resVillage=$this->input->post('resVillage');
		$resBarangay=$this->input->post('resBarangay');
		$resZipCode=$this->input->post('resZipCode');
		$resCity=$this->input->post('resCity');
		$resProvince=$this->input->post('resProvince');
		

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		$date=date("Y-m-d");
		$Password=sha1($this->input->post('BirthDate'));
		$Encoder=$this->session->userdata('username');
		
		//check if record exist
		$que=$this->db->query("select * from staff where IDNumber='".$IDNumber."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Employee Number is in use.</b></div>');
        redirect('Page/personnelEntry');
		}
		else
		{
		//save profile
		$que=$this->db->query("insert into staff values('$IDNumber','$FirstName','$MiddleName','$LastName','$NameExtn','$prefix','','$empPosition','$Department','$MaritalStatus','$empStatus','$BirthDate','$BirthPlace','$Sex','$height','$weight','$bloodType','$gsis','$pagibig','$philHealth','$sssNo','$tinNo','$resHouseNo','$resStreet','$resVillage','$resBarangay','$resCity','$resProvince','$resZipCode','$resHouseNo','$resStreet','$resVillage','$resBarangay','$resCity','$resProvince','$resZipCode','$empTelNo','$empMobile','$empEmail','1','','','$age','$dateHired','','$retYear','$agencyCode','$citizenship','$dualCitizenship','$citizenshipType','$citizenshipCountry','$contactName','$contactRel','$contactEmail','$contactNo','$contactAddress','$fb','$skype')");
		$que=$this->db->query("insert into users values('$IDNumber','$Password','Instructor','$FirstName','$MiddleName','$LastName','empEmail','avatar.png','Active','$date','$completeName','$IDNumber')");
		$que=$this->db->query("insert into atrail values('','Created Personnel Profile and User Account','$date','$now','$Encoder','$IDNumber')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Profile has been saved successfully.</b></div>');
        
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FirstName . ',' . "\r\n"; 
			$mail_message .= '<br><br>Your profile is now encoded to SRMS. Please take note of the following:' . "\r\n"; 
			$mail_message .= '<br>Username: <b>' . $IDNumber . '</b>' ."\r\n";
			$mail_message .= '<br>Password: <b>' . $BirthDate . '</b>'."\r\n";
			
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($empEmail)
				->subject('Account Created')
				->message($mail_message);
				$this->email->send();	
		
		redirect('Page/personnelEntry');
		}			
		} 
  }

//Update Personnel Profile
function updatePersonnelProfile()
	{
		 if($this->session->userdata('level')==='Admin'){
		 $id=$this->input->get('id');}
		 elseif($this->session->userdata('level')==='HR Admin'){
		 $id=$this->input->get('id');}
		 else{
		 $id=$this->session->userdata('IDNumber');}

		$result['data']=$this->StudentModel->staffProfile($id);
		$this->load->view('hr_personnel_profile_update_form',$result);
		 if($this->input->post('submit'))
		{
		//get data from the form
		$OldIDNumber=$this->input->post('OldIDNumber');
		$prefix=$this->input->post('prefix');
		$IDNumber=$this->input->post('IDNumber');
		$FirstName=strtoupper($this->input->post('FirstName'));
		$MiddleName=strtoupper($this->input->post('MiddleName'));	 
		$LastName=strtoupper($this->input->post('LastName'));
		$NameExtn=$this->input->post('NameExtn');
		$completeName=$FirstName.' '.$LastName;
		$Sex=$this->input->post('Sex');
		$BirthDate=$this->input->post('BirthDate');
		$age=$this->input->post('age');
		$BirthPlace=$this->input->post('BirthPlace');
		$MaritalStatus=$this->input->post('MaritalStatus');
		$height=$this->input->post('height');
		$weight=$this->input->post('weight');
		$bloodType=$this->input->post('bloodType');
		$empTelNo=$this->input->post('empTelNo');
		$empMobile=$this->input->post('empMobile');
		$empEmail=$this->input->post('empEmail');
		$fb=$this->input->post('fb');
		$skype=$this->input->post('skype');
		$citizenship=$this->input->post('citizenship');
		$dualCitizenship=$this->input->post('dualCitizenship');
		$citizenshipType=$this->input->post('citizenshipType');
		$citizenshipCountry=$this->input->post('citizenshipCountry');
		$empPosition=$this->input->post('empPosition');
		$Department=$this->input->post('Department');
		$empStatus=$this->input->post('empStatus');
		$agencyCode=$this->input->post('agencyCode');
		$dateHired=$this->input->post('dateHired');
		$retYear=$this->input->post('retYear');
		$gsis=$this->input->post('gsis');
		$pagibig=$this->input->post('pagibig');
		$philHealth=$this->input->post('philHealth');
		$sssNo=$this->input->post('sssNo');
		$tinNo=$this->input->post('tinNo');
		$contactName=$this->input->post('contactName');
		$contactRel=$this->input->post('contactRel');
		$contactEmail=$this->input->post('contactEmail');
		$contactNo=$this->input->post('contactNo');
		$contactAddress=$this->input->post('contactAddress');
		$resHouseNo=$this->input->post('resHouseNo');
		$resStreet=$this->input->post('resStreet');
		$resVillage=$this->input->post('resVillage');
		$resBarangay=$this->input->post('resBarangay');
		$resZipCode=$this->input->post('resZipCode');
		$resCity=$this->input->post('resCity');
		$resProvince=$this->input->post('resProvince');
		

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		$date=date("Y-m-d");
		$Password=sha1($this->input->post('BirthDate'));
		$Encoder=$this->session->userdata('username');
		//$description='Updated Personnel Information.  Old ID Number: '.$OldIDNumber.' '.' New IDNumber: '.$IDNumber.; 
		
		//save profile
		$que=$this->db->query("update staff set IDNumber='$IDNumber',FirstName='$FirstName',MiddleName='$MiddleName',LastName='$LastName',NameExtn='$NameExtn',prefix='$prefix',empPosition='$empPosition',Department='$Department',MaritalStatus='$MaritalStatus',empStatus='$empStatus',BirthDate='$BirthDate',BirthPlace='$BirthPlace',Sex='$Sex',height='$height',weight='$weight',bloodType='$bloodType',gsis='$gsis',pagibig='$pagibig',philHealth='$philHealth',sssNo='$sssNo',tinNo='$tinNo',resHouseNo='$resHouseNo',resStreet='$resStreet',resVillage='$resVillage',resBarangay='$resBarangay',resCity='$resCity',resProvince='$resProvince',resZipCode='$resZipCode',perHouseNo='$resHouseNo',perStreet='$resStreet',perVillage='$resVillage',perBarangay='$resBarangay',perCity='$resCity',perProvince='$resProvince',perZipCode='$resZipCode',empTelNo='$empTelNo',empMobile='$empMobile',empEmail='$empEmail',age='$age',dateHired='$dateHired',retYear='$retYear',agencyCode='$agencyCode',citizenship='$citizenship',dualCitizenship='$dualCitizenship',citizenshipType='$citizenshipType',citizenshipCountry='$citizenshipCountry',contactName='$contactName',contactRel='$contactRel',contactEmail='$contactEmail',contactNo='$contactNo',contactAddress='$contactAddress',fb='$fb',skype='$skype' where IDNumber='$OldIDNumber'");
		$que1=$this->db->query("update users set fName='$FirstName',mName='$MiddleName',lName='$LastName',email='$empEmail',IDNumber='$IDNumber' where username='$IDNumber'");
		$que2=$this->db->query("insert into atrail values('','Updated Personnel Profile','$date','$now','$Encoder','$OldIDNumber')");
		$this->session->set_flashdata('msg', '<div id="sa-success" class="alert alert-success text-center"><b>Updated successfully.</b></div>');
        redirect('Page/employeeList');
		}			
		}

  
  //Change Profile Pic
   function changeDP()
  {
	  	  $this->load->view('upload_profile_pic');	
  }
  
	public function uploadProfPic() 
	{
		$config['upload_path'] = './upload/profile/';
        $config['allowed_types'] = 'jpg|gif|png';
        $config['max_size'] = 2048;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('nonoy')) 
		{
            $msg = array('error' => $this->upload->display_errors());

            $this->load->view('upload_profile_pic', $msg);
        } 
		else 
		{
            $data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$username=$this->session->userdata('username');
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('file_name');
			
			$que=$this->db->query("update users set avatar='$filename' where username='$username'");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');
			$this->load->view('upload_profile_pic');
        }
    }
	
	public function createAccount()
	{
		$this->load->view('user_accounts');
		 if($this->input->post('submit'))
		{
		//get data from the form
		$username=$this->input->post('username');
		$IDNumber=$this->input->post('IDNumber');
		$password=sha1($this->input->post('password'));
		$acctLevel=$this->input->post('acctLevel');	 
		$fName=$this->input->post('fName');
		$mName=$this->input->post('mName');
		$lName=$this->input->post('lName');
		$completeName=$fName.' '.$lName;
		$email=$this->input->post('email');
		$dateCreated=date("Y-m-d");
		 
		//check if record exist
		$que=$this->db->query("select * from users where username='".$username."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Username is in use.</b></div>');
        redirect('Page/createAccount');
		}
		else
		{
		//save profile
		$que=$this->db->query("insert into users values('$username','$password','$acctLevel','$fName','$mName','$lName','$email','avatar.png','Active','$dateCreated','$completeName','$IDNumber')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success data-dismiss=alert text-center"><b>New account has been created successfully.</b></div>');
        redirect('Page/createAccount');
		}			
		} 
	}
	
	function updateStudeProfile()
		{
		 if($this->session->userdata('level')==='Student'){
		 $id=$this->session->userdata('username');}
		
		 else{
		 $id=$this->input->get('id');}
		 
		
		$result['data']=$this->StudentModel->displayrecordsById($id);
		$this->load->view('profile_form_update',$result);
		 if($this->input->post('submit'))
		{
		//get data from the form
		$oldStudentNo=$this->input->post('oldStudentNo');
		$StudentNumber=$this->input->post('StudentNumber');
		$FirstName=$this->input->post('FirstName');
		$MiddleName=$this->input->post('MiddleName');	 
		$LastName=$this->input->post('LastName');
		$nameExtn=$this->input->post('nameExtn');
		$Sex=$this->input->post('Sex');
		$CivilStatus=$this->input->post('CivilStatus');
		$Religion=$this->input->post('Religion');
		$Ethnicity=$this->input->post('Ethnicity');
		$MobileNumber=$this->input->post('MobileNumber');
		$BirthDate=$this->input->post('BirthDate');
		$BirthPlace=$this->input->post('BirthPlace');
		$BirthDate=$this->input->post('BirthDate');
		$Age=$this->input->post('Age');
		//Parents
		$Father=$this->input->post('Father');
		$FOccupation=$this->input->post('FOccupation');
		$Mother=$this->input->post('Mother');
		$MOccupation=$this->input->post('MOccupation');
		//Guardian Info
		$Guardian=$this->input->post('Guardian');
		$GuardianContact=$this->input->post('GuardianContact');
		$GuardianRelationship=$this->input->post('GuardianRelationship');
		$GuardianAddress=$this->input->post('GuardianAddress');
		//Address
		$Sitio=$this->input->post('Sitio');
		$Brgy=$this->input->post('Brgy');
		$City=$this->input->post('City');
		$Province=$this->input->post('Province');
		$email=$this->input->post('email');
		$working=$this->input->post('working');
		$nationality=$this->input->post('nationality');
		$Encoder=$this->session->userdata('username');
		$updatedDate=date("Y-m-d");
		$updatedTime=date("h:i:s A") . "\n"; 
		 
		//save profile
		$que1=$this->db->query("update studeprofile set StudentNumber='$StudentNumber',FirstName='$FirstName',MiddleName='$MiddleName',LastName='$LastName',nameExtn='$nameExtn',Sex='$Sex',CivilStatus='$CivilStatus',birthDate='$BirthDate',BirthPlace='$BirthPlace',Religion='$Religion',Ethnicity='$Ethnicity',contactNo='$MobileNumber',Encoder='$Encoder',BirthDate='$BirthDate',Father='$Father',FOccupation='$FOccupation',Mother='$Mother',MOccupation='$MOccupation',Guardian='$Guardian',GuardianContact='$GuardianContact',GuardianRelationship='$GuardianRelationship',GuardianAddress='$GuardianAddress',Sitio='$Sitio',Brgy='$Brgy',City='$City',Province='$Province',sitioPresent='$Sitio',brgyPresent='$Brgy',cityPresent='$City',provincePresent='$Province',Age='$Age',email='$email',working='$working',nationality='$nationality' where StudentNumber='$oldStudentNo'");
		$que2=$this->db->query("update semesterstude set StudentNumber='$StudentNumber',FName='$FirstName',MName='$MiddleName',LName='$LastName' where StudentNumber='$oldStudentNo'");
		$que3=$this->db->query("update paymentsaccounts set StudentNumber='$StudentNumber',FirstName='$FirstName',MiddleName='$MiddleName',LastName='$LastName' where StudentNumber='$oldStudentNo'");
		$que4=$this->db->query("update studeaccount set StudentNumber='$StudentNumber',FirstName='$FirstName',MiddleName='$MiddleName',LastName='$LastName' where StudentNumber='$oldStudentNo'");
		$que5=$this->db->query("update users set username='$StudentNumber',IDNumber='$StudentNumber',fName='$FirstName',mName='$MiddleName',lName='$LastName',email='$email' where username='$oldStudentNo'");
		$que6=$this->db->query("insert into atrail values('','Updated Profile','$updatedDate','$updatedTime','$Encoder','$StudentNumber')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Updated successfully.</b></div>');
        redirect('Page/updateStudeProfile');
		}			
		}

		
function masterlistByCourse()
{	$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		$course=$this->input->get('course');
		$result['data']=$this->StudentModel->byCourse($course, $sy, $sem);
		$result['data1']=$this->StudentModel->CourseYLCounts($course, $sy, $sem);
		$result['data2']=$this->StudentModel->SectionCounts($course, $sy, $sem);
	    $this->load->view('masterlist_by_course',$result);
}
function masterlistByCourseFiltered()
{	$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		$course = $this->input->get('course'); 
		$result['course']=$this->StudentModel->getCourse();
		$result['data']=$this->StudentModel->byCourse($course, $sy, $sem);
		$result['data1']=$this->StudentModel->CourseYLCounts($course, $sy, $sem);
		$result['data2']=$this->StudentModel->SectionCounts($course, $sy, $sem);
	$this->load->view('masterlist_by_course_filtered',$result);
}

function announcement()
{
	$result['data']=$this->StudentModel->announcement();
	$this->load->view('announcement',$result);
}

function viewAccounts()
{
	$result['data']=$this->StudentModel->viewAccounts();
	$this->load->view('settings_view_users',$result);
}

 //update user accounts
   function updateUserAccount(){
		$id=$this->input->get('id');
		$result['data']=$this->StudentModel->viewAccountsID($id);
   
     $this->load->view('user_accounts_update',$result);
	if($this->input->post('submit'))
		{
		//get data from the form
		$username=$this->input->post('username');
		$IDNumber=$this->input->post('IDNumber');
		$password=sha1($this->input->post('password'));
		$password2=$this->input->post('password');
		$acctLevel=$this->input->post('acctLevel');	 
		$fName=$this->input->post('fName');
		$mName=$this->input->post('mName');
		$lName=$this->input->post('lName');
		$completeName=$fName.' '.$lName;
		$email=$this->input->post('email');
		$date=date("Y-m-d");

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		$Encoder=$this->session->userdata('username');

		$que=$this->db->query("update users set password='$password',fName='$fName',mName='$mName',lName='$lName',position='$acctLevel',IDNumber='$IDNumber',email='$email' where username='$username'");
		$que=$this->db->query("update studeprofile set email='$email' where StudentNumber='$username'");
		$que=$this->db->query("insert into atrail values('','Updated user account','$date','$now','$Encoder','$username')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>The user account details have been updated successfully. </b></div>');
        
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $row[0]['fName'] . ',' . "\r\n"; ?> <br /> <br /><?php
			$mail_message .= 'Your user account has been updated.<br /> Your <b>new password</b> is <b>' . $password2 . '</b>' . "\r\n"; ?> <br /> <br /><?php
			//$mail_message .= '<br>Please Update your password.';
			$mail_message .= '<br>Thanks & Regards';
			$mail_message .= '<br>SoftTech Solutions';
	
			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Password')
				->message($mail_message);
				
		//Email Notification
			//$this->load->config('email');
			//$this->load->library('email');
			//$mail_message = 'Dear ' . $FName . ',' . "\r\n"; 
			//$mail_message .= '<br><br>Your enrollment details have been updated.' . "\r\n"; 
			//$mail_message .= '<br>Course: <b>' . $Course . '</b>' ."\r\n";
			//$mail_message .= '<br>Major: <b>' . $Major . '</b>'."\r\n";
			//$mail_message .= '<br>Year Level: <b>' . $YearLevel . '</b>'."\r\n";
			//$mail_message .= '<br>Section: <b>' . $Section . '</b>'."\r\n";
			//$mail_message .= '<br>Sem/SY: <b>' . $Semester . ', '. $SY .'</b>'."\r\n";
			//$mail_message .= '<br>Status: <b>Validated</b>'."\r\n";

			//$mail_message .= '<br><br>Thanks & Regards,';
			//$mail_message .= '<br>SRMS - Online';

			//$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
			//	->to($email)
			//	->subject('Enrollment')
			//	->message($mail_message);
			//	$this->email->send();
				
		redirect('Page/viewAccounts');
		}			

  }
  
	//Delete Announcement
	public function deleteUserAccount()
	{
	$id=$this->input->get('id');
	$this->StudentModel->deleteUserAccount($id);
	redirect("Page/viewAccounts");
	}
	
 public function uploadAnnouncement() 
	{
		$config['upload_path'] = './upload/announcements/';
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size'] = 5120;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('nonoy')) 
		{
            $msg = array('error' => $this->upload->display_errors());

            $this->load->view('announcement', $msg);
        } 
		else 
		{
            $data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$StudentNumber=$this->input->post('StudentNumber');
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('file_name');
			$title=$this->input->post('title');
			$encoder=$this->session->userdata('username');
			$datePosted=$datePosted=date("Y-m-d");
			$date=date("Y-m-d");
			
			$que=$this->db->query("insert into announcement values('','$datePosted','$title','$filename','$encoder')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');
			//$this->load->view('announcement');
			redirect('Page/announcement');
        }
    }
	
	//Requirements
	function uploadedRequirements()
	{
		$id=$this->input->get('id');
		$result['data']=$this->StudentModel->requirements($id);
		$this->load->view('uploaded_requirements',$result);
	}
	
	//Announcements
	function viewAnnouncement()
	{
		$result['data']=$this->StudentModel->announcement();
		$this->load->view('announcement_view',$result);
	}
	//Delete Announcement
	public function deleteAnnouncement()
	{
	$id=$this->input->get('id');
	$this->StudentModel->deleteAnnouncement($id);
	redirect("Page/announcement");
	}
	

	//Request
	public function submitRequest(){
		if($this->session->userdata('level')==='Student'){
		$id=$this->session->userdata('username');
		}else{
		$id=$this->input->get('id');};
		
		$result['data']=$this->StudentModel->studerequest($id);
		$result['data2']=$this->StudentModel->getTrackingNo();
		$this->load->view('request_submit',$result);
		
		if($this->input->post('submit'))
		{
			if($this->session->userdata('level')==='Student'){
				$fname=$this->session->userdata('fname');
			} else { $fname=$this->input->post('fname'); }
		
		$config['upload_path'] = './upload/reqDocs/';
       $config['allowed_types'] = 'pdf|jpeg|jpg|png';
        $config['max_size'] = 5120;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);
		$this->upload->do_upload('nonoy');
		$data = array('image_metadata' => $this->upload->data());
		$filename = $this->upload->data('file_name');		
		
		$email=$this->input->post('email');	
		$StudentNumber=$this->input->post('StudentNumber');
		$docName=$this->input->post('docName');
		$purpose=$this->input->post('purpose');
		$trackingNo=$this->input->post('trackingNo');
		$pReference=$this->input->post('pReference');
		$trackingNo=$this->input->post('trackingNo');
		
		$dateReq=date("Y-m-d");
		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		
		//check if record exist
		$que=$this->db->query("select * from stude_request where trackingNo='".$trackingNo."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Tracking No. is in use.</b></div>');
        redirect('Page/profileList');
		}
		else
		{		
		
		$que=$this->db->query("insert into stude_request values('$trackingNo','$docName','$purpose','$dateReq','$now','$StudentNumber','Open','$pReference','$filename')");
		$que=$this->db->query("insert into stude_request_stat values('','$StudentNumber','request submitted','$StudentNumber','$dateReq','$now','$trackingNo','Open','$filename','On Process')");
		$que=$this->db->query("insert into atrail values('','Requested a Document','$dateReq','$now','$id','$id')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Your request has been submitted.</b></div>');
		
		 //Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $fname . ',' . "\r\n"; 
			$mail_message .= '<br><br>Your request with tracking number <b>' . $trackingNo . ' </b>has been submitted.' . "\r\n"; 
			$mail_message .= '<br><br>Login to your portal to check the status of your request.' . "\r\n"; 
			
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Online Request')
				->message($mail_message);
				$this->email->send();
		if($this->session->userdata('level')==='Student'){		
		redirect('Page/student');
		}else{
			redirect('Page/allRequest');
		}
		}
}		
		} 

	function studentRequestStat(){
		$id=$this->input->get('trackingNo');
		$result['data']=$this->StudentModel->studerequestTracking($id);
		$this->load->view('stude_request_status',$result);
		
		if($this->input->post('submit'))
		{
		$config['upload_path'] = './upload/reqDocs/';
     $config['allowed_types'] = 'pdf|jpeg|jpg|png';
        $config['max_size'] = 5120;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);
		

		$this->upload->do_upload('nonoy');
		$data = array('image_metadata' => $this->upload->data());
		$filename = $this->upload->data('file_name');		
			
		$StudentNumber=$this->input->post('StudentNumber');
		$trackingNo=$this->input->post('trackingNo');
		$reqStatus=$this->input->post('reqStatus');
		$reqStat=$this->input->post('reqStat');

		$dateReq=date("Y-m-d");
		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
			
		$que=$this->db->query("update stude_request set reqStat='$reqStat' where trackingNo='$trackingNo'");
		$que=$this->db->query("insert into stude_request_stat values('','$StudentNumber','$reqStatus','$id','$dateReq','$now','$trackingNo','$reqStat','$filename','$reqStat')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>New request status has been posted.</b></div>');

		}	
		
	}
	
	public function lockScreen(){
		$this->load->view('lock-screen');
	}
	
	//delete student's profile
	public function deleteProfile()
	{
	$id=$this->input->get('id');
	$username=$this->session->userdata('username');
	date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
	$now = date('H:i:s A');
	$date=date("Y-m-d");
	$query=$this->db->query("delete from studeprofile where StudentNumber='".$id."'");
	$query=$this->db->query("insert into atrail values('','Deleted Student''s Profile','$date','$now','$username','$id')");
	redirect('Page/profileList');
	}

	//delete personnel's profile
	public function deletePersonnel()
	{
	$id=$this->input->get('id');
	$username=$this->session->userdata('username');
	date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
	$now = date('H:i:s A');
	$date=date("Y-m-d");
	$query=$this->db->query("delete from staff where IDNumber='".$id."'");
	$query=$this->db->query("insert into atrail values('','Deleted Personnel Profile','$date','$now','$username','$id')");
	redirect('Page/employeeList');
	}
	
	//delete student's enrollment
	public function deleteEnrollment()
	{
	$id=$this->input->get('id');	
	$query=$this->db->query("delete from semesterstude where semstudentid='".$id."'");
	$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Deleted successfully.</b></div>');
	redirect('Masterlist/enrolledList');
	}
	
 //update enrollment
   function updateEnrollment(){
		$id=$this->input->get('id');
        $semester = $this->session->userdata('semester');
		$sy = $this->session->userdata('sy');
		$courseVal = $this->input->post('course'); 
        $yearlevelVal = $this->input->post('yearlevel'); 
        $result['course']=$this->StudentModel->getCourse();
		$result['section']=$this->StudentModel->getSection();
		$result['courseVal'] = $courseVal;
		$result['data']=$this->StudentModel->masterlistAll2($id, $semester, $sy);
        $result['yearlevelVal'] = $yearlevelVal;
		
       	$this->load->view('enrollment_form_update',$result);
	if($this->input->post('submit'))
		{
		//get data from the form
		$id=$this->input->get('id');
		$email=$this->input->get('email');
		$StudentNumber=$this->input->post('StudentNumber');
		$FName=$this->input->post('FName');
		$MName=$this->input->post('MName');	 
		$LName=$this->input->post('LName');
		$Course=$this->input->post('Course');
		$YearLevel=$this->input->post('YearLevel');
		$Status=$this->input->post('Status');
		$Semester=$this->input->post('Semester');
		$SY=$this->input->post('SY');
		$Section=$this->input->post('Section');
		
		$StudeStatus=$this->input->post('StudeStatus');
		$YearLevelStat=$this->input->post('YearLevelStat');
		$Major=$this->input->post('Major');
		
		$EnrolledDate=date("Y-m-d");

		//save enrollment
		$que=$this->db->query("update semesterstude set Course='$Course',YearLevel='$YearLevel',Section='$Section',StudeStatus='$StudeStatus',YearLevelStat='$YearLevelStat',Major='$Major' where semstudentid='$id'");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Enrollment details have been updated successfully. </b></div>');
        
		
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FName . ',' . "\r\n"; 
			$mail_message .= '<br><br>Your enrollment details have been updated.' . "\r\n"; 
			$mail_message .= '<br>Course: <b>' . $Course . '</b>' ."\r\n";
			$mail_message .= '<br>Major: <b>' . $Major . '</b>'."\r\n";
			$mail_message .= '<br>Year Level: <b>' . $YearLevel . '</b>'."\r\n";
			$mail_message .= '<br>Section: <b>' . $Section . '</b>'."\r\n";
			$mail_message .= '<br>Sem/SY: <b>' . $Semester . ', '. $SY .'</b>'."\r\n";
			$mail_message .= '<br>Status: <b>Validated</b>'."\r\n";

			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Enrollment')
				->message($mail_message);
				$this->email->send();
				
		//redirect('Masterlist/masterlistAll');
		redirect('Masterlist/enrolledList');
		}			

  }	
   //Employee List (All)  
    function employeelist(){
	$result['data']=$this->PersonnelModel->displaypersonnel(); 
	$result['data1']=$this->PersonnelModel->personnelCounts();
	$result['data2']=$this->PersonnelModel->departmentcounts();		
	$this->load->view('hr_personnel_list',$result);
  }
    //Employee List By Department
    function employeelistDepartment(){
		$department=$this->input->get('department'); 
		$result['data']=$this->PersonnelModel->employeelistDepartment($department); 	
		$this->load->view('hr_personnel_list_department',$result);
  }
 
//Employee List By Position
    function employeelistPosition(){
		$position=$this->input->get('position'); 
		$result['data']=$this->PersonnelModel->employeelistPosition($position); 	
		$this->load->view('hr_personnel_list_position',$result);
  }
  
  public function upload201files(){
	 $this->load->view('hr_201files_upload');
  }
  public function process201Upload() 
	{
		$config['upload_path'] = './upload/201files/';
       $config['allowed_types'] = 'pdf|jpeg|jpg|png';
        $config['max_size'] = 5120;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('nonoy')) 
		{
            $msg = array('error' => $this->upload->display_errors());

            $this->load->view('upload201Files', $msg);
        } 
		else 
		{
            $data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$IDNumber=$this->input->post('IDNumber');
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('file_name');
			$docName=$this->input->post('docName');
			$date=date("Y-m-d");
			$que=$this->db->query("insert into hris_files values('','$IDNumber','$docName','$filename','$date')");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');
			redirect('Page/viewfilesAll');
        }
    }
	
	function viewfilesAll(){
		$result['data']=$this->PersonnelModel->viewfilesAll(); 
		$this->load->view('hr_201files',$result);	
  }
  
   function hr_files_individual(){
	$id=$this->input->get('id');	 
	$result['data']=$this->PersonnelModel->viewfiles($id);
	$this->load->view('hr_files_individual',$result);
	}
  
function closedDocRequest(){
	$result['data']=$this->StudentModel->closedDocRequest();
	$this->load->view('request_closed',$result);
}

function openDocRequest(){
	$result['data']=$this->StudentModel->openDocRequest();
	$this->load->view('request_open',$result);
}

function allRequest(){
	$result['data']=$this->StudentModel->allDocRequest();
	$this->load->view('request_all',$result);
}

function newRequest(){
	$result['data']=$this->StudentModel->getProfile();
	$this->load->view('request_search',$result);
}
	
	function requestSummary(){
	$result['data']=$this->StudentModel->totalStudeRequest();
	$result['data1']=$this->StudentModel->openRequest();
	$result['data2']=$this->StudentModel->closedRequest();
	$result['data3']=$this->StudentModel->docReqCounts();
	$result['data4']=$this->StudentModel->totalReleased();
	$result['data19']=$this->StudentModel->studeRequestList();
	$this->load->view('dashboard_request',$result);
}
	
	function releasedRequest(){
	$result['data']=$this->StudentModel->releasedRequest();
	$this->load->view('request_released',$result);
}
	
	//delete student's profile
	public function deleteRequest()
	{
	$id=$this->input->get('id');
	$username=$this->session->userdata('username');
	date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
	$now = date('H:i:s A');
	$date=date("Y-m-d");
	$query=$this->db->query("delete from stude_request where trackingNo='".$id."'");
	$query=$this->db->query("insert into atrail values('','Deleted Student''s Request','$date','$now','$username','$id')");
	redirect('Page/profileList');
	}
	
	 //deny enrollment
   function denyEnrollment(){
       $this->load->view('enrollment_form_deny');
	if($this->input->post('submit'))
		{
		//get data from the form
		$email=$this->input->get('email');
		$StudentNumber=$this->input->post('StudentNumber');
		$FName=$this->input->post('FName');
		$MName=$this->input->post('MName');	 
		$LName=$this->input->post('LName');
		$reason=$this->input->post('reason');
		
		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$timeDenied = date('H:i:s A');
		$dateDenied=date("Y-m-d");
		$processor=$this->session->userdata('username');
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		
		//save denial
		//$que=$this->db->query("insert into semesterstude values('','$StudentNumber','$FName','$MName','$LName','$Course','$YearLevel','Enrolled','$Semester','$SY','Term','$Section','$StudeStatus','','','','','','','0','$YearLevelStat','$Major','1','$EnrolledDate','','','','','','','')");
		$que=$this->db->query("insert into online_enrollment_deny values('','$StudentNumber','$FName','$MName','$LName','$reason','$dateDenied','$timeDenied','$processor','$sem','$sy')");
		$que1=$this->db->query("update online_enrollment set enrolStatus='Denied' where StudentNumber='$StudentNumber' and Semester='$sem' and SY='$sy'");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Denied successfully! </b></div>');

		redirect('Page/forValidation');
		}			
  }
  

	function deniedPayments()
	{
		$result['data']=$this->StudentModel->deniedPayments();
		$this->load->view('denied_payments',$result);
	}
	

	function voidORs()
	{
		$result['data']=$this->StudentModel->voidORs();
		$this->load->view('voidORs',$result);
	}
}