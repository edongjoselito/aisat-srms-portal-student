<?php
class HR extends CI_Controller{
  function __construct(){
    parent::__construct();
	$this->load->database();
    $this->load->helper('url');
    $this->load->model('InstructorModel');
	
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
 function forLeaveApproval(){
		
	$this->load->view('hr_forApproval');
 }
 
  function forRetirement(){
		
	$this->load->view('hr_forRetirement');
 }
 
  function forLoyalty(){
		
	$this->load->view('hr_forLoyalty');
 }
  function staffBday(){
		
	$this->load->view('hr_staff_bday');
 } 
}
