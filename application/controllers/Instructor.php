<?php
class Instructor extends CI_Controller{
  function __construct(){
    parent::__construct();
	$this->load->database();
    $this->load->helper('url');
    $this->load->model('InstructorModel');
	
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
 function facultyLoad(){
	 if($this->session->userdata('level')==='Admin'){
		 $id=$this->input->get('id');}
		 elseif($this->session->userdata('level')==='HR Admin'){
		 $id=$this->input->get('id');}
		 else{
		 $id=$this->session->userdata('IDNumber');}
	
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$result['data']=$this->InstructorModel->facultyLoad($id, $sy, $sem);	
	$this->load->view('faculty_load',$result);
 }
 
 function subjectsMasterlist(){
	$id=$this->input->get('id');
	$section=$this->input->get('section');
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$result['data']=$this->InstructorModel->facultyMasterlist($id, $sy, $sem, $section);	
	$this->load->view('masterlist_by_subject',$result);
 }
 
 function subjectGrades(){
	$id=$this->input->get('id');
	$subjectcode=$this->input->get('subjectcode');
	//$description=$this->input->get('description');
	$section=$this->input->get('section');
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$result['data']=$this->InstructorModel->subjectGrades($id, $sy, $sem, $section, $subjectcode);	
	$this->load->view('subject_grades',$result);
 }
 
  function gradingSheets(){
	$instructor=$this->session->userdata('fName').''.$this->session->userdata('lName');
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$result['data']=$this->InstructorModel->gradingSheets($id, $sy, $sem);	
	$this->load->view('grading_sheets',$result);
 }
}
