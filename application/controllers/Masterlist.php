<?php
class Masterlist extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
	$this->load->helper('url', 'form');	
	$this->load->library('form_validation');
    $this->load->model('StudentModel');
	

    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
//Masterlist by Grade Level
  function masterlistAll(){
		$semester = $this->session->userdata('semester');
		$sy = $this->session->userdata('sy');
		$result['data']=$this->StudentModel->masterlistAll($semester, $sy);
		$this->load->view('masterlist_all',$result);	
  }

//Grades Summary
		function gradesSummary(){
			$sy = $this->input->get('sy');
		$sem = $this->input->get('sem');
		$result['data']=$this->StudentModel->gradesSummary($sy,$sem);
		$this->load->view('registrar_grades_summary',$result);

		if($this->input->post('submit'))
		{
		$sy = $this->input->get('sy');
		$sem = $this->input->get('sem');
		$result['data']=$this->StudentModel->gradesSummary($sy,$sem);
		$this->load->view('registrar_grades_summary',$result);
  }}
   
//Masterlist by Grade Level
  function byGradeYL(){
		$yearlevel = $this->input->get('yearlevel'); 
        $semester = $this->session->userdata('semester');
		$sy = $this->session->userdata('sy');
		$result['data']=$this->StudentModel->byGradeLevel($yearlevel, $semester, $sy);
		$result['data1']=$this->StudentModel->byGradeLevelCount($yearlevel, $semester, $sy);
		$this->load->view('masterlist_by_gradelevel',$result);

		if($this->input->post('submit'))
		{
		$yearlevel = $this->input->get('yearlevel'); 
       $semester = $this->input->get('semester'); 
		$sy = $this->session->userdata('sy');
		$result['data']=$this->StudentModel->byGradeLevel($yearlevel, $semester, $sy);
		$result['data1']=$this->StudentModel->byGradeLevelCount($yearlevel, $semester, $sy);
		$this->load->view('masterlist_by_gradelevel',$result);
  }}
	//Masterlist by Section
    function bySection(){
		$section = $this->input->get('section'); 
        $semester = $this->input->get('semester'); 
		$sy = $this->session->userdata('sy');
		$result['data']=$this->StudentModel->bySection($section, $semester, $sy);
		$this->load->view('masterlist_by_section',$result);

		if($this->input->post('submit'))
		{
		$section = $this->input->get('section'); 
        $semester = $this->input->get('semester'); 
		$sy = $this->session->userdata('sy');
		$result['data']=$this->StudentModel->bySection($section, $semester, $sy);
		$this->load->view('masterlist_by_section',$result);
  }}
	//enrolled list
	  function enrolledList(){
		$sy = $this->session->userdata('sy');
		$sem =$this->session->userdata('semester');
		$result['data']=$this->StudentModel->bySY($sy,$sem);
		$this->load->view('enrolled_list',$result);
	  }
	  
	//Masterlist By School Year
   function bySY(){
		$sy = $this->session->userdata('sy');
		$sem =$this->session->userdata('semester');
		$result['data']=$this->StudentModel->bySY($sy,$sem);
		$this->load->view('masterlist_by_sy',$result);

		if($this->input->post('submit'))
		{
		$sy = $this->input->get('sy'); 
		$result['data']=$this->StudentModel->bySY($$sy);
		$this->load->view('masterlist_by_sy',$result);
  }}
	//Masterlist Daily Enrollment
     function dailyEnrollees(){
		$date = $this->input->get('date'); 
		$result['data']=$this->StudentModel->byDate($date);
		$result['data1']=$this->StudentModel->byDateCourseSum($date);
		$this->load->view('masterlist_daily_enrollees',$result);

		if($this->input->post('submit'))
		{
		$date = $this->input->get('date'); 
		$result['data']=$this->StudentModel->byDate($date);
		$result['data1']=$this->StudentModel->byDateCourseSum($date);
		$this->load->view('masterlist_daily_enrollees',$result);
  }}
 
		//Masterlist by Course
		function byCourse(){
		$sy = $this->session->userdata('sy');
		$sem = $this->session->userdata('semester');
		$course=$this->input->get('course');
		$result['data']=$this->StudentModel->byCourse($course, $sy, $sem);
		$this->load->view('masterlist_by_course',$result);

		if($this->input->post('submit'))
		{
		$sy = $this->session->userdata('sy');
		$department=$this->input->get('department');
		$result['data']=$this->StudentModel->byDepartment($department, $sy);
		$this->load->view('masterlist_by_department',$result);
  }}
  
  		//Masterlist by Enrolled Online
		function byEnrolledOnline(){
		$sy = $this->session->userdata('sy');
		$department=$this->input->get('department');
		$result['data']=$this->StudentModel->byEnrolledOnline($department, $sy);
		$this->load->view('masterlist_by_oe',$result);

		if($this->input->post('submit'))
		{
		$sy = $this->session->userdata('sy');
		$department=$this->input->get('department');
		$result['data']=$this->StudentModel->byEnrolledOnline($department, $sy);
		$this->load->view('masterlist_by_oe',$result);
  }}
  
    	//Masterlist for Payment Acceptance
		function forPaymentAcceptance(){
		$result['data']=$this->StudentModel->byEnrolledOnline();
		$this->load->view('masterlist_by_op_verification',$result);

		if($this->input->post('submit'))
		{
		$result['data']=$this->StudentModel->byEnrolledOnline();
		$this->load->view('masterlist_by_op_verification',$result);
  }}
		
		//Masterlist by Religion
		function studeReligion(){
		$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$religion=$this->input->get('religion');	
		$result['data']=$this->StudentModel->religionList($sem,$sy,$religion);
		$this->load->view('masterlist_by_religion',$result);
		}
		//Masterlist by City
		function cityList(){
		$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$city=$this->input->get('city');	
		$result['data']=$this->StudentModel->cityList($sem,$sy,$city);
		$this->load->view('masterlist_by_city',$result);
		}
		//Masterlist by Ethnicity
		function ethnicityList(){
		$sy=$this->session->userdata('sy');
		$sem=$this->session->userdata('semester');
		$ethnicity=$this->input->get('ethnicity');	
		$result['data']=$this->StudentModel->ethnicityList($sem,$sy,$ethnicity);
		$this->load->view('masterlist_by_ethnicity',$result);
		}
		//Masterlist of Teachers
		function teachers(){
		$result['data']=$this->StudentModel->teachers();
		$this->load->view('masterlist_teachers',$result);
		}
		
		//Masterlist by Enrolled Online
		function byEnrolledOnlineSem(){
		$sy = $this->session->userdata('sy');
		$sem = $this->session->userdata('semester');
		$result['data']=$this->StudentModel->byEnrolledOnlineSem($sem, $sy);
		$this->load->view('masterlist_by_oe',$result);
		}
		function byEnrolledOnlineAll(){
			$result['data']=$this->StudentModel->byEnrolledOnlineAll();
			$this->load->view('masterlist_by_oe_all',$result);
		}
		
		function studeGrades(){
			$studeno=$this->input->get('studeno');
			$sy = $this->session->userdata('sy');
			$sem = $this->session->userdata('semester');
			$result['data']=$this->StudentModel->studeGrades($studeno, $sem, $sy);
			$this->load->view('stude_grades',$result);
		}
		
		function deniedEnrollees(){
			$sy = $this->session->userdata('sy');
			$sem = $this->session->userdata('semester');
			$result['data']=$this->StudentModel->deniedEnrollees($sem, $sy);
			$this->load->view('denied_enrollees',$result);
		}
		
			function studeGradesView(){
				 if($this->session->userdata('level')==='Student'){
					$studeno=$this->session->userdata('username');
					$sy = $this->session->userdata('sy');
					$sem = $this->session->userdata('semester');
					$result['data']=$this->StudentModel->studeGrades($studeno, $sem, $sy);
					$this->load->view('stude_grades_view',$result);
					
			}else{
				$studeno=$this->input->get('studeno');
					$sy = $this->session->userdata('sy');
					$sem = $this->session->userdata('semester');
					$result['data']=$this->StudentModel->studeGrades($studeno, $sem, $sy);
					$this->load->view('stude_grades_view',$result);
			}
		}
		
			function COR(){
			 if($this->session->userdata('level')==='Student'){	
				 $studeno=$this->session->userdata('username');
				// $sy = $this->session->userdata('sy');
				// $sem = $this->session->userdata('semester');
				$sy = $this->input->post('sy');
				$sem = $this->input->post('sem');
				$result['data']=$this->StudentModel->studeCOR($studeno, $sem, $sy);
				$this->load->view('stude_cor',$result);
			 }else
			 {
			$studeno=$this->input->get('studeno');
			$sy = $this->session->userdata('sy');
			$sem = $this->session->userdata('semester');
			$result['data']=$this->StudentModel->studeCOR($studeno, $sem, $sy);
			$this->load->view('stude_cor',$result);
			}}
			
			public function slotsMonitoring(){
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['data']=$this->StudentModel->slotsMonitoring($sem, $sy);
				$this->load->view('registrar_slots_monitoring',$result);
			}
			
			public function subjectMasterlist(){
				$subjectcode=$this->input->get('subjectcode');
				$section=$this->input->get('section');
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['data']=$this->StudentModel->subjectMasterlist($sem,$sy,$subjectcode,$section);
				$this->load->view('registrar_subject_masterlist',$result);
			}
			
			public function crossEnrollees(){
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['data']=$this->StudentModel->crossEnrollees($sem, $sy);
				$this->load->view('registrar_cross_enrollees',$result);
			}
			
			public function fteRecords(){
				$course=$this->input->get('course');
				$yearlevel=$this->input->get('yearlevel');
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['course']=$this->StudentModel->getCourse();
				$result['data']=$this->StudentModel->fteRecords($sem,$sy,$course,$yearlevel);
				$this->load->view('registrar_fte_records',$result);
			}

			public function subregistration(){
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['data']=$this->StudentModel->slotsMonitoring($sem, $sy);
				$this->load->view('registrar_subjects',$result);
			}
			
			public function grades(){
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['data']=$this->StudentModel->grades($sem, $sy);
				$this->load->view('registrar_grades',$result);
			}
			
			public function gradeSheets(){
				$SubjectCode = $this->input->get('SubjectCode'); 
				$Description = $this->input->get('Description'); 
				//$Instructor = $this->input->get('Instructor'); 
				$Section = $this->input->get('Section'); 
				$sy = $this->session->userdata('sy');
				$sem = $this->session->userdata('semester');
				$result['data']=$this->StudentModel->gradeSheets($sem, $sy, $SubjectCode, $Description, $Section);
				$this->load->view('registrar_grades_sheets',$result);
			}
}