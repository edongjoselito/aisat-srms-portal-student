<?php
class LibraryModel extends CI_Model 
{

	function reportsAllBooks()
	{
	$query=$this->db->query("Select * from libbookentry");
	return $query->result();
	}
	
	function bookDetails($id)
	{
	$query=$this->db->query("Select * from libbookentry where BookID='".$id."'");
	return $query->result();
	}
	
	function getBookCategory()
	{
		$this->db->select('*');
		$this->db->order_by('Category','ASC');
		$query=$this->db->get('libcategory');
		return $query->result();

	}
	
	function getBookLocation()
	{
		$this->db->select('*');
		$this->db->order_by('location','ASC');
		$query = $this->db->get('liblocation');
		return $query->result();
	}
	
	function getPublisher()
	
	{
		$this->db->select('*');
		$this->db->order_by('publisher','ASC');
		$query=$this->db->get('libpublisher');
		return $query->result();
	}

	

	//Student Total Semesters Enrolled
	function semStudeCount($id)
	{
	$query=$this->db->query("SELECT StudentNumber, count(Semester) as SemesterCounts FROM semesterstude where StudentNumber='".$id."' group by StudentNumber");

	return $query->result();

        if($query->num_rows() > 0)
        {
           return $query->result();
        }
        return false;
	}
	



}
