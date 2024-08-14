<?php
class SRMS extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
	$this->load->helper('url', 'form');	
	$this->load->library('form_validation');
	$this->load->model('StudentModel');
  }

  function about(){
        
	  $this->load->view('about');
       }
	   
	     function faq(){
        
	  $this->load->view('faq');
       }
	   
	     function announcement(){
         $result['data']=$this->StudentModel->announcement();
	  $this->load->view('public_announcement',$result);
       }
}