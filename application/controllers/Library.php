<?php
class Library extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
	$this->load->helper('url', 'form');	
	$this->load->library('form_validation');
    $this->load->model('LibraryModel');
	 $this->load->model('SettingsModel');

    if($this->session->userdata('logged_in') !== TRUE){
      redirect('login');
    }
  }
//Update Books
function updateBooks(){
		$id=$this->input->get('id');
		$result['category']=$this->LibraryModel->getBookCategory();
		$result['location']=$this->LibraryModel->getBookLocation();
		$result['publisher']=$this->LibraryModel->getPublisher();
		$result['settings']=$this->SettingsModel->getSchoolInfo();
		$result['data']=$this->LibraryModel->bookDetails($id);
		
		$this->load->view('lib_book_update',$result);
		 if($this->input->post('submit'))
		 {
		$BookNo=$this->input->post('BookNo');
		$Title=$this->input->post('Title');
		$AuthorNum=$this->input->post('AuthorNum');
		$Author=$this->input->post('Author');
		$coAuthors=$this->input->post('coAuthors');
		$Publisher=$this->input->post('Publisher');
		$YPublished=$this->input->post('YPublished');
		$Subject=$this->input->post('Subject');
		$ISBN=$this->input->post('ISBN');
		$Edition=$this->input->post('Edition');
		$CallNum=$this->input->post('CallNum');
		$Category=$this->input->post('Category');
		$Location=$this->input->post('Location');
		$DeweyNum=$this->input->post('DeweyNum');
		$AccNo=$this->input->post('AccNO');
		$Price=$this->input->post('Price');
		
		$Encoder=$this->session->userdata('username');
		$updatedDate=date("Y-m-d");		

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		
		$date=date("Y-m-d");

		$que=$this->db->query("update libbookentry set BookNo='$BookNo',Title='$Title',AuthorNum='$AuthorNum',Author='$Author',coAuthors='$coAuthors',Publisher='$Publisher',YPublished='$YPublished',Subject='$Subject',ISBN='$ISBN',Edition='$Edition',CallNum='$CallNum',Category='$Category',Location='$Location',DeweyNum='$DeweyNum',AccNo='$AccNo',Price='$Price' where BookID='".$id."'");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Updated successfully.</b></div>');

		redirect('Library/Books');
		 }
		 }			

//Masterlist All Books
  function booksEntry(){
		$result['data']=$this->LibraryModel->getBookCategory();
		$result['location']=$this->LibraryModel->getBookLocation();
		$result['publisher']=$this->LibraryModel->getPublisher();
		$result['settings']=$this->SettingsModel->getSchoolInfo();
		$this->load->view('lib_book_entry',$result);
		
	if($this->input->post('submit'))
		{
		$settingsID=$this->input->post('settingsID');
		$BookNo=$this->input->post('BookNo');
		$Title=$this->input->post('Title');
		$AuthorNum=$this->input->post('AuthorNum');
		$Author=$this->input->post('Author');
		$coAuthors=$this->input->post('coAuthors');
		$Publisher=$this->input->post('Publisher');
		$YPublished=$this->input->post('YPublished');
		$Subject=$this->input->post('Subject');
		$ISBN=$this->input->post('ISBN');
		$Edition=$this->input->post('Edition');
		$CallNum=$this->input->post('CallNum');
		$Category=$this->input->post('Category');
		$Location=$this->input->post('Location');
		$DeweyNum=$this->input->post('DeweyNum');
		$AccNo=$this->input->post('AccNo');
		$Price=$this->input->post('Price');
		$bookCover=$this->input->post('bookCover');
		
		$Encoder=$this->session->userdata('username');
		$updatedDate=date("Y-m-d");		

		date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
		$now = date('H:i:s A');
		
		$date=date("Y-m-d");
		
	
		//check if record exist
		$que=$this->db->query("select * from libbookentry where BookNo='".$BookNo."'");
		$row = $que->num_rows();
		if($row)
		{
		 //redirect('Page/notification_error');
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"><b>Book Number is in use.</b></div>');
        redirect('Library/Books');
		}
		else
		{
		//save profile
		$que=$this->db->query("insert into libbookentry values('0','$BookNo','$Title','$AuthorNum','$Author','$coAuthors','$Publisher','$YPublished','$Subject','$ISBN','$Edition','$CallNum','$Category','$Location','$DeweyNum','$AccNo','$Price','$date','In','$settingsID','$bookCover')");
		//$que=$this->db->query("insert into atrail values('','Created Student''s Profile and User Account','$AdmissionDate','$now','$Encoder','$StudentNumber')");
		$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"><b>Saved successfully.</b></div>');

		redirect('Library/Books');
		}			
		} 
  }		
  
//Masterlist All Books
  function reportsAllBooks(){
		$result['data']=$this->LibraryModel->reportsAllBooks();
		$this->load->view('lib_reports_all_books',$result);	
  }
  
//Masterlist All Books
  function Books(){
		$result['data']=$this->LibraryModel->reportsAllBooks();
		$this->load->view('lib_books',$result);	
  }
 //View Book Details
  function bookDetails(){
	    $id=$this->input->get('id');
		$result['data']=$this->LibraryModel->bookDetails($id);
		$this->load->view('lib_book_details',$result);	
  }
 //Delete Books 
  	function deleteBook($id)
	{
	$id=$this->input->get('id');
	$username=$this->session->userdata('username');
	date_default_timezone_set('Asia/Manila'); # add your city to set local time zone
	$now = date('H:i:s A');
	$date=date("Y-m-d");
	$query=$this->db->query("delete from libbookentry where BookID='".$id."'");
	$query=$this->db->query("insert into atrail values('','Deleted a book','$date','$now','$username','$id')");
	redirect('Library/Books');
	
	}
	
	function borrow(){
		$this->load->view('lib_book_borrow');	
	}
	
		function returnbooks(){
		$this->load->view('lib_book_return');	
	}
	
		function author(){
		$this->load->view('lib_book_settings_author');	
	}
	
			function category(){
		$this->load->view('lib_book_settings_category');	
	}
	
			function location(){
		$this->load->view('lib_book_settings_location');	
	}
	
			function publisher(){
		$this->load->view('lib_book_settings_publisher');	
	}
}