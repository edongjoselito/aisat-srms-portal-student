<?php
class Accounting extends CI_Controller{
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

function denyPayment(){
	$this->load->view('payment_deny');
	
	 if($this->input->post('submit'))
		{
		//get data from the form
		
		$opID=$this->input->post('opID');
		$email=$this->input->get('email');	 
		$FirstName=$this->input->get('FirstName');	
		$amount=$this->input->get('amount');	 		
		$StudentNumber=$this->input->post('StudentNumber');	 
		$denyReason=$this->input->post('denyReason');
		$deniedDate=date("Y-m-d");
		$text1="Denied Payment";
		$transDescription=$result = $text1 . ' - ' . $opID . ' '. $denyReason;

		 $Encoder=$this->session->userdata('username');
		//check if record exist
		$que=$this->db->query("select * from online_pay_deny where opID='".$opID."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>This payment was already denied.</b></div>');
       redirect('Page/proof_payment_view');
		}
		else
		{
		//save profile
		$que=$this->db->query("insert into online_pay_deny values('','$opID','$StudentNumber','$denyReason','$deniedDate')");
		//update online payment table
		$que=$this->db->query("update online_payments set depositStat='Denied' where opID='$opID'");
		//Save to audit trail
		$que=$this->db->query("insert into atrail values('','$transDescription','$deniedDate','','$Encoder','$StudentNumber')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Denied successfully.</b></div>');
        
		//Email Notification
			$this->load->config('email');
			$this->load->library('email');
			$mail_message = 'Dear ' . $FirstName . ',' . "\r\n"; 
			$mail_message .= '<br><br>The payment you submitted has been denied.' . "\r\n"; 
			$mail_message .= '<br>Reason: <b>' . $denyReason . '</b>' ."\r\n";
			$mail_message .= '<br>Amount: <b>' . $amount . '</b>' ."\r\n";
			$mail_message .= '<br>Denied Date: <b>' . $deniedDate . '</b>'."\r\n";
			
			$mail_message .= '<br><br>Thanks & Regards,';
			$mail_message .= '<br>SRMS - Online';

			$this->email->from('no-reply@lxeinfotechsolutions.com', 'SRMS Online Team')
				->to($email)
				->subject('Payment Denied')
				->message($mail_message);
				$this->email->send();
		
		redirect('Page/proof_payment_view');
		}			
		} 
		
}

 function collectionReport(){
		$from = $this->input->get('from'); 
		$to = $this->input->get('to'); 
		$result['data']=$this->StudentModel->collectionReport($from, $to);
		$result['data1']=$this->StudentModel->collectionTotal($from, $to);
		$result['data2']=$this->StudentModel->collectionSummary($from, $to);
		$this->load->view('collection_report',$result);

		if($this->input->post('submit'))
		{
		$from = $this->input->get('from'); 
		$to = $this->input->get('to'); 
		$result['data']=$this->StudentModel->collectionReport($from, $to);
		$result['data1']=$this->StudentModel->collectionTotal($from, $to);
		$result['data2']=$this->StudentModel->collectionSummary($from, $to);
		$this->load->view('collection_report',$result);
  }}

  function collectionYear(){
		$year = $this->input->get('year'); 
		$result['data']=$this->StudentModel->collectionYear($year);
		$result['data1']=$this->StudentModel->collectionTotalYear($year);
		$this->load->view('collection_year',$result);

		if($this->input->post('submit'))
		{
		$year = $this->input->get('year'); 
		$result['data']=$this->StudentModel->collectionYear($year);
		$result['data1']=$this->StudentModel->collectionTotalYear($year);
		$this->load->view('collection_year',$result);

  }}
function studeAccounts(){
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$course = $this->input->get('course'); 
	$yearlevel=$this->input->get('yearlevel');
	$result['course']=$this->StudentModel->getCourse();
	$result['data']=$this->StudentModel->studeAccounts($sem,$sy,$course,$yearlevel);
	$this->load->view('accounting_students_accounts',$result);
	if($this->input->post('submit'))
		{
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		$course=$this->input->get('course');
		$yearlevel=$this->input->get('yearlevel');
		$result['course']=$this->StudentModel->getCourse();
		$result['data']=$this->StudentModel->studeAccounts($sem,$sy,$course,$yearlevel);
		$this->load->view('accounting_students_accounts',$result);
  }}
 
function studeAccountsWithBalance(){
	$sem=$this->session->userdata('semester');
	$sy=$this->session->userdata('sy');
	$course = $this->input->get('course'); 
	$yearlevel=$this->input->get('yearlevel');
	$result['course']=$this->StudentModel->getCourse();
	$result['data']=$this->StudentModel->studeAccountsWithBalance($sem,$sy,$course,$yearlevel);
	$this->load->view('accounting_students_with_balance',$result);
	if($this->input->post('submit'))
		{
		$sem=$this->session->userdata('semester');
		$sy=$this->session->userdata('sy');
		$course=$this->input->get('course');
		$yearlevel=$this->input->get('yearlevel');
		$result['course']=$this->StudentModel->getCourse();
		$result['data']=$this->StudentModel->studeAccountsWithBalance($sem,$sy,$course,$yearlevel);
		$this->load->view('accounting_students_with_balance',$result);
  }}
  
  function accountingStudeReports(){
	  $result['data']=$this->StudentModel->getProfile(); 
	  $this->load->view('accounting_stude_reports',$result);
  }

  function studentStatement(){
  	
	  	
		$id=$this->session->userdata('username');
		$sem=$this->input->post('sem');
		$sy=$this->input->post('sy');
		
	  $result['data']=$this->StudentModel->studentStatement($id, $sem, $sy);
		$result['data1']=$this->SettingsModel->getSchoolInfo();	  
	  $this->load->view('accounting_stude_account',$result);

	
  }
}