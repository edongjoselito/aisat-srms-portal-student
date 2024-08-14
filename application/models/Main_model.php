<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    function insertRecord($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('StudentNumber', $record[0]);
            $q = $this->db->get('studeprofile');
            $response = $q->result_array();
            
            // Insert record
            if(count($response) == 0){
                $newprofile = array(
                    "StudentNumber" => trim($record[0]),
                    "FirstName" => trim($record[1]),
                    "MiddleName" => trim($record[2]),
                    "LastName" => trim($record[3]),
					"Sex" => trim($record[4]),
					"CivilStatus" => trim('Civil Status'),
					"BirthPlace" => trim('Birth Place'),
					"Religion" => trim('Religion'),
					"email" => trim(''),
					"email" => trim(''),
					"contactNo" => trim(''),
					"working" => trim(''),
					"occupation" => trim(''),
					"salary" => trim(''),
					"employer" => trim(''),
					"employerAddress" => trim(''),
					"BirthDate" => date("Y-m-d"),
					"admissionDate" => date("Y-m-d"),
					"graduationDate" => date("Y-m-d"),
					"guardian" => trim(''),
					"guardianRelationship" => trim(''),
					"guardianContact" => trim(''),
					"guardianAddress" => trim(''),
					"spouse" => trim(''),
					"spouseRelationship" => trim(''),
					"spouseContact" => trim(''),
					"children" => trim(''),
					"spouseIncome" => trim(''),
					"imagePath" => trim(''),
					"course" => trim(''),
					"yearLevel" => trim(''),
					"father" => trim(''),
					"fOccupation" => trim(''),
					"fatherAddress" => trim(''),
					"mother" => trim(''),
					"mOccupation" => trim(''),
					"motherAddress" => trim(''),
					"siblings" => trim(''),
					"birthOrder" => trim(''),
					"age" => trim(''),
					"title" => trim(''),
					"pronoun" => trim(''),
					"pronoun2" => trim(''),
					"pronoun3" => trim(''),
					"scholarship" => trim(''),
					"ethnicity" => trim(''),
					"fourPs" => trim(''),
					"seniorCitizen" => trim(''),
					"als" => trim(''),
					"disability" => trim(''),
					"parentsMonthly" => trim(''),
					"province" => trim(''),
					"city" => trim(''),
					"brgy" => trim(''),
					"sitio" => trim(''),
					"provincePresent" => trim(''),
					"cityPresent" => trim(''),
					"brgyPresent" => trim(''),
					"sitioPresent" => trim(''),
					"elementary" => trim(''),
					"elementaryAddress" => trim(''),
					"elemGraduated" => trim(''),
					"elemMerits" => trim(''),
					"secondary" => trim(''),
					"secondaryAddress" => trim(''),
					"secondaryGraduated" => trim(''),
					"secondaryMerits" => trim(''),
					"vocational" => trim(''),
					"vocationalAddress" => trim(''),
					"vocationalCourse" => trim(''),
					"ncLevel" => trim(''),
					"transfereeSchool" => trim(''),
					"transfereeAddress" => trim(''),
					"transfereeCourse" => trim(''),
					"transfereeGraduated" => trim(''),
					"skills" => trim(''),
					"settingsID" => trim('1'),
					"applicationNo" => trim(''),
					"testCenter" => trim(''),
					"testDate" => trim('2020-01-01'),
					"encoder" => trim($this->session->userdata('username')),
					"admissionSem" => trim(''),
					"admissionSY" => trim(''),
					"admissionBasis" => trim(''),
					"lastAttended" => trim(''),
					"lastSchool" => trim(''),
					"lastSchoolDate" => trim(''),
					"honors" => trim(''),
					"rotcSerial" => trim(''),
					"cwtsSerial" => trim(''),
					"4psNo" => trim(''),
					"nameExtn" => trim(''),
					"fatherContact" => trim(''),
					"motherContact" => trim(''),
					"nationality" => trim('Filipino'),
					
					);
					$newuser = array(
                    "username" => trim($record[0]),
                    "password" => sha1($record[5]),
                    "position" => trim('Student'),
                    "fName" => trim($record[1]),
                    "mName" => trim($record[2]),
                    "lName" => trim($record[3]),
					"email" => trim(''),
					"avatar" => trim('avatar.png'),
					"acctStat" => trim('active'),
					"dateCreated" => date("Y-m-d"),
					"name" => trim(''),
					);

                $this->db->insert('studeprofile', $newprofile);
				$this->db->insert('users', $newuser);
            }
            
        }
        
    }
    function insertTeachers($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('IDNumber', $record[0]);
            $q = $this->db->get('staff');
            $response = $q->result_array();
            
            // Insert record
            if(count($response) == 0){
                $newprofile = array(
                    "IDNumber" => trim($record[0]),
                    "FirstName" => trim($record[1]),
                    "MiddleName" => trim($record[2]),
                    "LastName" => trim($record[3]),
					"NameExtn" => trim(''),
					"prefix" => trim(''),
					"jobTitle" => trim(''),
					"empPosition" => trim(''),
					"Department" => trim(''),
					"MaritalStatus" => trim(''),
					"empStatus" => trim(''),
					"BirthDate" => date("Y-m-d"),
					"BirthPlace" => trim(''),
					"Sex" => trim($record[4]),
					"height" => trim(''),
					"weight" => trim(''),
					"bloodType" => trim(''),
					"gsis" => trim(''),
					"pagibig" => trim(''),
					"philHealth" => trim(''),
					"sssNo" => trim(''),
					"tinNo" => trim(''),
					"dateHired" => trim('2020-01-01'),
					"resHouseNo" => trim(''),
					"resStreet" => trim(''),
					"resVillage" => trim(''),
					"resBarangay" => trim(''),
					"resCity" => trim(''),
					"resProvince" => trim(''),
					"resZipCode" => trim(''),
					"perHouseNo" => trim(''),
					"perStreet" => trim(''),
					"perVillage" => trim(''),
					"perBarangay" => trim(''),
					"perCity" => trim(''),
					"perProvince" => trim(''),
					"perZipCode" => trim(''),
					"empTelNo" => trim(''),
					"empMobile" => trim(''),
					"empEmail" => trim(''),
					"settingsID" => trim('1'),
					);
					$newuser = array(
                    "username" => trim($record[0]),
					"password" => sha1($record[5]),
                    "position" => trim('Instructor'),
                    "fName" => trim($record[1]),
                    "mName" => trim($record[2]),
                    "lName" => trim($record[3]),
					"email" => trim(''),
					"avatar" => trim('avatar.png'),
					"acctStat" => trim('active'),
					"dateCreated" => date("Y-m-d"),
					
                  );

                $this->db->insert('staff', $newprofile);
				$this->db->insert('users', $newuser);
            }
            
        }
        
    }
	    function insertCourses($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('CourseCode', $record[0]);
            $q = $this->db->get('course_table');
            $response = $q->result_array();
            
            // Insert record
            if(count($response) == 0){
                $newcourse = array(
                    "CourseCode" => trim($record[0]),
                    "CourseDescription" => trim($record[1]),
					"Major" => trim($record[2]),
					"Duration" => trim($record[3]),
					);
                $this->db->insert('course_table', $newcourse);
            }
       }
    }
	
		function insertSections($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('Section', $record[0]);
            $q = $this->db->get('sections');
            $response = $q->result_array();
            
            // Insert record
            if(count($response) == 0){
                $newsection = array(
                    "Section" => trim($record[0]),
                  
					);
                $this->db->insert('sections', $newsection);
            }
       }
    }
	
		function insertSubjects($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('SubjectCode', $record[0]);
			$this->db->where('description', $record[1]);
			$this->db->where('Course', $record[5]);
			$this->db->where('Major', $record[6]);
            $q = $this->db->get('subjects');
            $response = $q->result_array();
            
            // Insert record
            if(count($response) == 0){
                $newsubject = array(
                    "SubjectCode" => trim($record[0]),
					"description" => trim($record[1]),
					"lecunit" => trim($record[2]),
					"labunit" => trim($record[3]),
					"prereq" => trim(''),
					"curriculum" => trim(''),
					"YearLevel" => trim($record[7]),
					"Semester" => trim($record[8]),
					"Course" => trim($record[5]),
					"SemEffective" => trim(''),
					"SYEffective" => trim(''),
					"Effectivity" => trim(''),
					"Major" => trim($record[6]),
					"totalUnits" => trim($record[4]),
                  
					);
                $this->db->insert('subjects', $newsubject);
            }
       }
    }
	
		function insertFees($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('Description', $record[0]);
			$this->db->where('Course', $record[2]);
			$this->db->where('YearLevel', $record[4]);
			$this->db->where('Semester', $record[5]);
            $q = $this->db->get('fees');
            $response = $q->result_array();
            
            // Insert record
            if(count($response) == 0){
                $fees = array(
                    "feesid" => trim('0'),
					"Description" => trim($record[0]),
					"Amount" => trim($record[1]),
					"Course" => trim($record[2]),
					"Major" => trim($record[3]),
					"YearLevel" => trim($record[4]),
					"Semester" => trim($record[5]),
					"feesType" => trim($record[6]),
					                  
					);
                $this->db->insert('fees', $fees);
            }
       }
    }
}