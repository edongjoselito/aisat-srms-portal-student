<?php
class Import extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->model('StudentModel');
		$this->load->model('SettingsModel');
		$this->load->model('Import_model');
		$this->load->library('excel');
		if ($this->session->userdata('logged_in') !== TRUE) {
			redirect('login');
		}
		if ($this->session->userdata('level') !== 'Admin') {
			echo "Access Denied";
		}
	}

	function index()
	{
			$this->load->view('import');
	}

	function fetch()
	{
		$data = $this->Import_model->select();
		$output = '
		<h3 align="center">Total Data - '.$data->num_rows().'</h3>
		<table id="table1" class="table table-striped table-bordered">
			<thead>
			<tr>
				<th>LRN</th>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Birth Date</th>
			</tr>
			</thead>
			<tbody>
		';
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>
				<td>'.$row->StudentNumber.'</td>
				<td>'.$row->LastName.'</td>
				<td>'.$row->FirstName.'</td>
				<td>'.$row->MiddleName.'</td>
				<td>'.$row->birthDate.'</td>
			</tr>
			';
		}
		$output .= '</tbody></table>';
		echo $output;
	}

	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$dataCount = 0;
				$dupCount = 0;
				for($row=2; $row<=$highestRow; $row++)
				{
					$studentNumber = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					if($this->Import_model->checkStudentNumber($studentNumber)==0){
						$firstName = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$middleName = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$lastName = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						$birthDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow(4, $row)->getValue()));
						$data[] = array(
							'StudentNumber'		=>	$studentNumber,
							'FirstName'			=>	$firstName,
							'MiddleName'		=>	$middleName,
							'LastName'			=>	$lastName,
							'BirthDate'			=>	$birthDate
						);
						$dataCount++;
					}
					else{
						$dupCount++;
					}
					
				}
			}
			$message = "Empty file or LRN already exists";
			if (!empty($data)){
				$this->Import_model->insert($data);
				$message = $dataCount.' data imported successfully. '.$dupCount. ' existing LRN.';
			}

			echo $message;
			
			
		}	
	}
}
