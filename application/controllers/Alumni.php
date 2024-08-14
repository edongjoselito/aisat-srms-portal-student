<?php
class Alumni extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
	$this->load->helper('url', 'form');	
	$this->load->library('form_validation');
    $this->load->model('AlumniModel');
	$this->load->model('StudentModel');
	$this->load->model('SettingsModel');	
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  function index(){
    if($this->session->userdata('level')==='Admin'){
		$result['data']=$this->AlumniModel->totalAlumni(); 
		$result['data1']=$this->AlumniModel->employedCounts();
		$result['data2']=$this->AlumniModel->unemployedCounts();
		$result['data3']=$this->AlumniModel->noStatCounts();
		$result['data4']=$this->AlumniModel->byCourseCount();
		$result['data5']=$this->AlumniModel->byNatureWorkCount();
		$result['data6']=$this->AlumniModel->byPositionCount();
		$result['data7']=$this->AlumniModel->selfEmployedCounts();
		$result['data8']=$this->AlumniModel->governmentEmployedCounts();
		$result['data9']=$this->AlumniModel->privateEmployedCounts();
		
		$result['data18']=$this->SettingsModel->getSchoolInfo();
	    $this->load->view('dashboard_alumni',$result);
    }else{
        echo "Access Denied";
    }
	
  }
  
  function alumniBatch()
{	
	$syGraduated = $this->input->get('sy'); 
	$result['data']=$this->AlumniModel->alumniBatch($syGraduated);
	$this->load->view('alumni_batch',$result);
}

  function alumniAll()
{	
	$syGraduated = $this->input->get('sy'); 
	$result['data']=$this->AlumniModel->alumniAll();
	$this->load->view('alumni_all',$result);
}

  function selfEmployed()
{	
	$result['data']=$this->AlumniModel->selfEmployed();
	$this->load->view('alumni_selfemployed',$result);
}

  function employed()
{	
	$result['data']=$this->AlumniModel->employed();
	$this->load->view('alumni_employed',$result);
}

  function unemployed()
{	
	$result['data']=$this->AlumniModel->unemployed();
	$this->load->view('alumni_unemployed',$result);
}

function nostatus()
{	
	$result['data']=$this->AlumniModel->nostatus();
	$this->load->view('alumni_nostatus',$result);
}

  function masterlistGovernmentEmployed()
{	
	$result['data']=$this->AlumniModel->masterlistGovernmentEmployed();
	$this->load->view('alumni_government_employed',$result);

}

function masterlistPrivateEmployed()
{	
	$result['data']=$this->AlumniModel->masterlistPrivateEmployed();
	$this->load->view('alumni_private_employed',$result);

}

function alumniProfilePage()
{			$id = $this->input->get('id'); 
			$result['data']=$this->AlumniModel->displayrecordsById($id);  
			$result['data1']=$this->StudentModel->profilepic($id);	
						
	$this->load->view('alumni_page',$result);
}
 
}