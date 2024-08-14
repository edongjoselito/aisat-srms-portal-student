<?php
class Student extends CI_Controller{
  function __construct(){
    parent::__construct();
	$this->load->database();
    $this->load->helper('url');
    $this->load->model('StudentModel');
	
    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
 
  function index(){

      if($this->session->userdata('level')==='Student'){
          $this->load->view('account_tracking');
      }else{
          echo "Access Denied";
      }
 
  }

 function downloads(){
	 $this->load->view('download_resources');
 }
  


}
