<?php
class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('Login_model');
	 $this->load->model('SettingsModel');
  }
 
  function index(){
    $result['data']=$this->Login_model->loginImage();
    $result['data1']=$this->Login_model->getSem();
    $this->load->view('home_page',$result);
  }
  
    function faq(){
    $result['data']=$this->Login_model->loginImage();
    //$this->output->cache(60);
    $this->load->view('web-faq',$result);
  }
  
  function login(){
    $result['data']=$this->Login_model->loginImage();
    //$this->output->cache(60);
    $this->load->view('home_page',$result);
  }

  

function registration(){
	//$this->output->cache(60);
	$this->load->view('registration_form');
	
    if($this->input->post('register'))
    {
	$query1 = $this->db->query("SELECT *  from srms_settings");
    $row = $query1->result_array();
	
    $lrn=$this->input->post('lrn');
    $fname=strtoupper($this->input->post('fname'));
    $mname=strtoupper($this->input->post('mname'));
    $lname=strtoupper($this->input->post('lname'));
	$completeName=$fname.' '.$lname;
	$sex=$this->input->post('sex');
	$bdate=$this->input->post('bdate');
    $contactno=$this->input->post('contactno');
    $email=$this->input->post('email');
    $date= date('Y-m-d');
    $pass=$this->input->post('pass');
    $h_upass = sha1($pass);
    
	$Address=$this->input->post('Address');
	$Father=$this->input->post('Father');
	$FOccupation=$this->input->post('FOccupation');
	$Mother=$this->input->post('Mother');
	$MOccupation=$this->input->post('MOccupation');
	$Guardian=$this->input->post('Guardian');
	$GuardianRelationship=$this->input->post('GuardianRelationship');
	$GuardianContact=$this->input->post('GuardianContact');
	$MobileNumber=$this->input->post('MobileNumber');
	$CivilStatus=$this->input->post('CivilStatus');
	$Religion=$this->input->post('Religion');
	$Ethnicity=$this->input->post('Ethnicity');
	$working=$this->input->post('working');
	$spouse=$this->input->post('spouse');
	$fatherContact=$this->input->post('fatherContact');
	$motherContact=$this->input->post('motherContact');
	$semester=$this->input->post('semester');
	$sy=$this->input->post('sy');
	
    $que=$this->db->query("select * from users where username='".$lrn."'");
    $row = $que->num_rows();
    if($row)
    {
    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Record already exist.</b></div>');
    }
    else
    {
    $que=$this->db->query("insert into users values('$lrn','$h_upass','Student','$fname','$mname','$lname','$email','avatar.png','active','$date','$completeName','$lrn')");
    $que1=$this->db->query("insert into studeprofile values('$lrn','$fname','$mname','$lname','$sex','$CivilStatus','','$Religion','$email','$MobileNumber','$working','','','','','$bdate','$date','$date','$Guardian','$GuardianRelationship','$GuardianContact','','$spouse','','','','','','','','$Father','$FOccupation','','$Mother','$MOccupation','','','','0','','','','','','$Ethnicity','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','1','','','$date','$lrn','','','','','','','','','','','','$fatherContact','$motherContact','Filipino')");
    $que=$this->db->query("insert into studentsignup values('','$lrn','$fname','$mname','$lname','$StudentType','$semester','$sy','$date')");
	$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Registration details have been processed successfully.</b></div>');
    redirect('Login');
	
	      //Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $fname . ',' . "\r\n"; 
			$mail_message .= '<br><br>Thank you for signing up!' . "\r\n"; 
			$mail_message .= '<br><br>You may now login to the system using <span style="color:red; font-weight:bold;">' .$lrn. '</span> as your username and <span style="color:red; font-weight:bold;">' . $pass . ' </span> as your password.' ."\r\n";
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Account Created')
				->message($mail_message);
				$this->email->send();
	redirect('Login');
    }     

    }
	
	
    }
  
  

  function auth(){
    $username    = $this->input->post('username', TRUE);
    $password = sha1($this->input->post('password', TRUE));
    $sy=$this->input->post('sy',TRUE);
    $semester=$this->input->post('semester',TRUE);
	 $validate = $this->Login_model->validate($username, $password);
																
    if($validate->num_rows() > 0){
        $data  = $validate->row_array();
        $username  = $data['username'];
		$fname  = $data['fName'];
		$mname  = $data['mName'];
		$lname  = $data['lName'];
		$avatar  = $data['avatar'];
        $email = $data['email'];
        $level = $data['position'];
		$IDNumber = $data['IDNumber'];
        $user_data = array(

            'username'  => $username,
			'fname'  => $fname,
			'mname'  => $mname,
			'lname'  => $lname,
			'avatar'  => $avatar,
            'email'     => $email,
            'level'     => $level,
			'IDNumber'     => $IDNumber,
            'sy' => $sy,
            'semester' => $semester,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($user_data);
        // 1 - access login for admin
        if($level === 'Student'){
            redirect('page/student');   		 

	}} else {
            echo $this->session->set_flashdata('msg', 'The username or password is incorrect!');
            redirect('Login/login');
        }
}

 
  function logout(){
      $this->session->sess_destroy();
      redirect('login');
  }
    public function forgot_pass()
    {
        $email = $this->input->post('email');
        $findemail = $this->Login_model->forgotPassword($email);
        if ($findemail) {
            $this->Login_model->sendpassword($findemail);
        }
        else {
            $this->session->set_flashdata('msg', ' Email not found!');
            redirect(base_url() . 'login', 'refresh');
        }
    }

 
}