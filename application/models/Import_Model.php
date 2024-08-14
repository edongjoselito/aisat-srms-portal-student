<?php
class Import_model extends CI_Model
{
	function select()
	{
		$this->db->order_by('LastName', 'ASC');
		$query = $this->db->get('studeprofile');
		return $query;
	}

	function insert($data)
	{
		$this->db->insert_batch('studeprofile', $data);
	}

	function checkStudentNumber($studentNumber)
	{
		$query = $this->db->get_where('studeprofile', array(
            'StudentNumber' => $studentNumber
        ));
        return $query->num_rows();
	}
}
