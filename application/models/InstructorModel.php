<?php
class InstructorModel extends CI_Model 
{

function facultyLoad($id, $sy, $sem){
	$query=$this->db->query("SELECT * FROM semsubjects where IDNumber='".$id."' and SY='".$sy."' and Semester='".$sem."' order by SubjectCode");
	return $query->result();
	}

function facultyMasterlist($id, $sy, $sem, $section){
	$query=$this->db->query("SELECT p.StudentNumber, concat(p.LastName,', ',p.FirstName) as StudentName, mid(p.MiddleName,1) as MiddleName, r.Course, r.YearLevel, r.Section FROM studeprofile p join registration r on p.StudentNumber=r.StudentNumber where r.Instructor='".$id."' and r.SY='".$sy."' and r.Sem='".$sem."' and r.Section='".$section."' group by p.StudentNumber order by StudentName");
	return $query->result();
	}
function subjectGrades($id, $sy, $sem, $section, $subjectcode){
	$query=$this->db->query("SELECT p.StudentNumber, concat(p.LastName,', ',p.FirstName) as StudentName, mid(p.MiddleName,1) as MiddleName, g.Course, g.Section, g.Final FROM studeprofile p join grades g on p.StudentNumber=g.StudentNumber where g.SubjectCode='".$subjectcode."' and g.SY='".$sy."' and g.Semester='".$sem."' and g.Section='".$section."' and g.Instructor='".$id."' group by p.StudentNumber order by p.LastName");
	return $query->result();
	}
function gradingSheets($instructor, $sy, $sem){
	$query=$this->db->query("SELECT * FROM grades where Instructor='".$instructor."' and Semester='".$sem."' and SY='".$sy."' group by SubjectCode, Section");
	return $query->result();
	}
}
