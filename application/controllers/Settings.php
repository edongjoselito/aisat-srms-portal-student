<?php
class Settings extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
	$this->load->helper('url', 'form');	
	$this->load->library('form_validation');
    $this->load->model('StudentModel');
	$this->load->model('SettingsModel');
	
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
  
  function Sections ()
  {
	  $result['data']=$this->SettingsModel->getSectionList();
	  $this->load->view('settings_sections',$result);
	  
	if($this->input->post('submit'))
		{
		//get data from the form
		$Section=$this->input->post('Section');
		
		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		$date=date("Y-m-d");
		$Password=sha1($this->input->post('BirthDate'));
		$Encoder=$this->session->userdata('username');
		
		$description='Encoded a section '.$Section;
		//check if record exist
		$que=$this->db->query("select * from sections where Section='".$Section."'");
		$row = $que->num_rows();
		if($row)
		{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Duplicate entry.</b></div>');
        redirect('Settings/Sections');
		}
		else
		{
		//save section
		$que=$this->db->query("insert into sections values('','$Section')");
		$que=$this->db->query("insert into atrail values('','$description','$date','$now','$Encoder','')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>One record added successfully.</b></div>');
        redirect('Settings/Sections');
		}			
		} 
  }
  
  	//delete Section
	public function deleteSection()
	{
	$id=$this->input->get('id');
	$username=$this->session->userdata('username');
	date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
	$now = date('H:i:s A');
	$date=date("Y-m-d");
	$query=$this->db->query("delete from sections where sectionID='".$id."'");
	$query=$this->db->query("insert into atrail values('','Deleted a Section','$date','$now','$username','$id')");
	redirect('Settings/Sections');
	}
  //delete Course
	public function deleteCourse()
	{
	$id=$this->input->get('id');
	$username=$this->session->userdata('username');
	date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
	$now = date('H:i:s A');
	$date=date("Y-m-d");
	$query=$this->db->query("delete from course_table where courseid='".$id."'");
	$query=$this->db->query("insert into atrail values('','Deleted a Course','$date','$now','$username','$id')");
	redirect('Settings/Department');
	}
   function Department ()
  {
	  $result['data']=$this->SettingsModel->getDepartmentList();
	  $this->load->view('settings_department',$result);
	  
	if($this->input->post('submit'))
		{
		//get data from the form
		$CourseCode=$this->input->post('CourseCode');
		$CourseDescription=$this->input->post('CourseDescription');
		$Major=$this->input->post('Major');
		$Duration=$this->input->post('Duration');

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		$date=date("Y-m-d");
		$Password=sha1($this->input->post('BirthDate'));
		$Encoder=$this->session->userdata('username');
		
		$description='Encoded a Course '.$CourseDescription;
		
		//check if record exist
		$que=$this->db->query("select * from course_table where CourseDescription='".$CourseDescription."' and Major='".$Major."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Duplicate entry.</b></div>');
        redirect('Settings/Department');
		}
		else
		{
		//save track
		$que=$this->db->query("insert into course_table values('','$CourseCode','$CourseDescription','$Major','$Duration')");
		$que=$this->db->query("insert into atrail values('','$description','$date','$now','$Encoder','')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>One record added successfully.</b></div>');
        redirect('Settings/Department');
		}			
		} 
  }
   public function schoolInfo()
  {
	  $result['data']=$this->SettingsModel->getSchoolInfo();
	  $this->load->view('settings_school_info',$result);
	  if($this->input->post('submit'))
		{
		$SchoolName=$this->input->post('SchoolName');
		$SchoolAddress=$this->input->post('SchoolAddress');
		$SchoolHead=$this->input->post('SchoolHead');
		$sHeadPosition=$this->input->post('sHeadPosition');	 
		$Registrar=$this->input->post('Registrar');	 
		$registrarPosition=$this->input->post('registrarPosition');
		$clerk=$this->input->post('clerk');
		$clerkPosition=$this->input->post('clerkPosition');
		$administrative=$this->input->post('administrative');
		$administrativePosition=$this->input->post('administrativePosition');
		$admissionOfficer=$this->input->post('admissionOfficer');
		$accountant=$this->input->post('accountant');
		$cashier=$this->input->post('cashier');
		$cashierPosition=$this->input->post('cashierPosition');
		$PropertyCustodian=$this->input->post('PropertyCustodian');
		$slogan=$this->input->post('slogan');
		
		$Encoder=$this->session->userdata('username');
		$updatedDate=date("Y-m-d");
		$updatedTime=date("h:i:s A") . "\n"; 
		 
		//save profile
		$que=$this->db->query("update srms_settings set SchoolName='$SchoolName',SchoolAddress='$SchoolAddress',SchoolHead='$SchoolHead',sHeadPosition='$sHeadPosition',Registrar='$Registrar',registrarPosition='$registrarPosition',clerk='$clerk',clerkPosition='$clerkPosition',administrative='$administrative',administrativePosition='$administrativePosition',cashier='$cashier',cashierPosition='$cashierPosition',admissionOfficer='$admissionOfficer',accountant='$accountant',PropertyCustodian='$PropertyCustodian',slogan='$slogan'");
		$que=$this->db->query("insert into atrail values('','Updated the School Info','$updatedDate','$updatedTime','$Encoder','')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Updated successfully.</b></div>');
        redirect('Settings/schoolInfo');
		}			
		}


  public function loginFormBanner()
  {
	  $this->load->view('settings_login_image');
  }
  public function uploadloginFormImage() 
	{
		$config['upload_path'] = './upload/banners/';
        $config['allowed_types'] = 'jpg|gif|png';
        $config['max_size'] = 15000;
        //$config['max_width'] = 1500;
        //$config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('nonoy')) 
		{
            $msg = array('error' => $this->upload->display_errors());

           $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Error uploading the file.</b></div>');
        } 
		else 
		{
            $data = array('image_metadata' => $this->upload->data());
			//get data from the form
			$username=$this->session->userdata('username');
			//$filename=$this->input->post('nonoy');
			$filename = $this->upload->data('file_name');
			
			$que=$this->db->query("update srms_settings set loginFormImage='$filename'");
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Uploaded Succesfully!</b></div>');
			//$this->load->view('loginFormImage');
			redirect('Settings/loginFormBanner');
        }
    }

}