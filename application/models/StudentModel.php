<?php
class StudentModel extends CI_Model 
{
	//ADMIN ANNOUNCEMENT ---------------------------------------------------------------------------------
	function announcement(){
	$query=$this->db->query("Select * from announcement order by aID desc");
	return $query->result();
	}
	
	function deleteAnnouncement($id)
	{
	$this->db->query("delete  from announcement where aID='".$id."'");
	}
	
	function deleteUserAccount($id)
	{
	$this->db->query("delete  from users where username='".$id."'");
	}
 
	function gradesSummary($sy,$sem)
	{
	$query=$this->db->query("select ss.StudentNumber, concat(ss.lName,', ',ss.fName,' ',ss.mName) as StudentName, ss.Course, ss.YearLevel, g.SubjectCode, g.Final, g.Semester, g.SY from grades g join semesterstude ss on g.StudentNumber=ss.StudentNumber  where ss.SY='".$sy."' and ss.Semester='".$sem."' and g.SY='".$sy."' and g.Semester='".$sem."' order by g.SubjectCode, StudentName, ss.YearLevel");
	return $query->result();
	}
	
  function getTrackingNo()
	{
	$query=$this->db->query("select * from stude_request order by trackingNo desc limit 1");
	return $query->result();
	}

	//VIEW DENIED ENROLLEES ---------------------------------------------------------------------------------
	function deniedEnrollees($sem,$sy){
	$query=$this->db->query("Select * from online_enrollment_deny where sem='".$sem."' and sy='".$sy."' order by LastName");
	return $query->result();
	}

	//VIEW DENIED PAYMENTS ---------------------------------------------------------------------------------
	function deniedPayments(){
	$query=$this->db->query("SELECT o.StudentNumber, p.LastName, p.FirstName, p.MiddleName, o.denyReason, o.deniedDate FROM studeprofile p join online_pay_deny o on p.StudentNumber=o.StudentNumber order by o.opID desc");
	return $query->result();
	}

	//VOID ORS ---------------------------------------------------------------------------------
	function voidORs(){
	$query=$this->db->query("SELECT * FROM voidreceipts order by ORNumber desc");
	return $query->result();
	}
	
	//VIEW REQUIREMENTS ---------------------------------------------------------------------------------
	function requirements($id){
	$query=$this->db->query("Select * from online_requirements where StudentNumber='".$id."' order by fileAttachment");
	return $query->result();
	}
	
	//USER ACCOUNTS ---------------------------------------------------------------------------------
	function viewAccounts(){
	$query=$this->db->query("SELECT * FROM users order by lName");
	return $query->result();
	}
	
	function viewAccountsID($id){
	$query=$this->db->query("SELECT * FROM users where username='".$id."'");
	return $query->result();
	}
	
	//STUDENTS REQUEST ---------------------------------------------------------------------------------
	function studerequest($id){
	$query=$this->db->query("SELECT * FROM stude_request where StudentNumber='".$id."' order by dateReq desc");
	return $query->result();
	}
	
	//Released Request
	function totalReleased()
	{
	$query=$this->db->query("SELECT ongoingStat, count(ongoingStat) as requestCounts FROM stude_request_stat where ongoingStat='Released' group by ongoingStat");
	return $query->result();}
	
		//Released Request
	function releasedRequest()
	{
	$query=$this->db->query("select * from stude_request sr join stude_request_stat st on sr.trackingNo=st.trackingNo join studeprofile p on st.StudentNumber=p.StudentNumber where st.ongoingStat='Released'");
	return $query->result();}
	
	function studerequestTracking($id){
	$query=$this->db->query("SELECT * FROM stude_request sr join stude_request_stat st on sr.trackingNo=st.trackingNo where sr.trackingNo='".$id."' order by statID desc");
	return $query->result();
	}
	
	function studeaccountById($id){
	$query=$this->db->query("Select Course, Sem, SY, concat(Sem,', ',SY) as Semester, Format(AcctTotal,2) as AcctTotal, Format(TotalPayments,2) as TotalPayments, Format(CurrentBalance,2) as CurrentBalance, Discount, StudentNumber, FirstName, MiddleName, LastName from studeaccount where StudentNumber='".$id."' group by Semester order by AccountID desc, Sem");
	return $query->result();
	}
	
	function studepayments($studentno,$sem,$sy){
	$query=$this->db->query("SELECT p.StudentNumber, concat(s.FirstName,' ',s.LastName) as StudentName, s.Course, s.PDate, s.ORNumber, Format(s.Amount,2) as Amount, s.description, s.Sem, s.SY FROM paymentsaccounts s join studeprofile p on p.StudentNumber=s.StudentNumber where p.StudentNumber='".$studentno."' and s.Sem='".$sem."' and s.SY='".$sy."' and s.CollectionSource!='Services' and s.ORStatus='Valid'");
	return $query->result();
	}
	
	//Student Grades
	function studeGrades2($studeno, $sem, $sy){
	$query=$this->db->query("SELECT * FROM studeprofile s join grades g on s.StudentNumber=g.StudentNumber where s.StudentNumber='".$studeno."' and g.Semester='".$sem."' and g.SY='".$sy."'");
	return $query->result();
	}

	//Student Grades
	function studeGrades($studeno){
	//$query=$this->db->query("SELECT * FROM studeprofile s join grades g on s.StudentNumber=g.StudentNumber where s.StudentNumber='".$studeno."'");
	$query=$this->db->query("SELECT * FROM grades where StudentNumber='".$studeno."' ORDER BY SY, Semester, SubjectCode ASC");
	
	return $query->result();
	}
	
	//Student COR
	function studeCOR($studeno,$sem,$sy){
	$query=$this->db->query("SELECT * FROM studeprofile s join registration r on s.StudentNumber=r.StudentNumber where s.StudentNumber='".$studeno."' and r.Sem='".$sem."' and r.SY='".$sy."'");
	return $query->result();
	}
	
	//FTE Records
	function fteRecords($sem,$sy,$course,$yearlevel){
	$query=$this->db->query("SELECT LastName, FirstName, MiddleName, Sem, SY, Course, Major, YearLevel, sum(LecUnit) as LecUnit, sum(LabUnit) as LabUnit FROM registration where Sem='".$sem."' and SY='".$sy."' and Course='".$course."' and YearLevel='".$yearlevel."' group by StudentNumber order by LastName");
	return $query->result();
	}
	
	//function paymentsrep($paymentType_id){
		//	$this->db->select('Course, PDate, ORNumber, Amount, description, PaymentType, CONCAT(LastName, '.', FirstName) AS StudentName', FALSE);
		//	$this->db-> from ('paymentsaccounts');
		//	$this->db->where('PaymentType', $paymentType_id);
		//	$query= $this->db->get();
		//	if($query->num_rows()>0){
		//	return $query->result_array();
		//	} else {return FALSE;}
		//}
	//Display Students Profile
	function displayrecordsById($id)
	{
	$query=$this->db->query("select * from studeprofile where StudentNumber='".$id."'");
	return $query->result();
	}
	//Display Staff Profile
	function staffProfile($id)
	{
	$query=$this->db->query("select * from staff where IDNumber='".$id."'");
	return $query->result();
	}
	
function getOR()
	{
	$query=$this->db->query("select * from paymentsaccounts order by ID desc limit 1");
	return $query->result();
	}

	function UploadedPayments($id, $sem, $sy)
	{
	$query=$this->db->query("select * from online_payments where StudentNumber='".$id."' and sy='".$sy."' and sem='".$sem."'");
	return $query->result();
	}

	function UploadedPaymentsAdmin($sem, $sy)
	{
	$query=$this->db->query("SELECT * FROM online_payments o join studeprofile p on o.StudentNumber=p.StudentNumber where o.sy='".$sy."' and o.sem='".$sem."' and o.depositStat='For Verification'");
	return $query->result();
	}

	function onlinePaymentsAll()
	{
	$query=$this->db->query("select * from online_payments op join studeprofile p on op.StudentNumber=p.StudentNumber join online_enrollment oe on p.StudentNumber=oe.StudentNumber group by op.opID");
	return $query->result();
	}
	
	function displayenrollees()
	{
	$query=$this->db->query("select * from online_enrollment order by LastName");
	return $query->result();
	}

	//Chart of Enrollment
	function chartEnrollment(){
	$query=$this->db->query("SELECT concat(Semester,', ',SY) as Sem, count(Semester) as Counts FROM semesterstude group by Sem");
	return $query->result();}
	
	//Counts of Teachers
	function teachersCount(){
	$query=$this->db->query("SELECT count(IDNumber) as staffCount FROM staff");
	return $query->result();}
	
	//Counts for Validation
	function forValidationCounts($Semester,$SY){
	$query=$this->db->query("SELECT count(oe.StudentNumber) as StudeCount FROM online_enrollment oe join studeprofile p on oe.StudentNumber=p.StudentNumber where oe.Semester='".$Semester."' and oe.SY='".$SY."' and oe.enrolStatus='For Validation'");
	return $query->result();}
	
	//Counts for Total Profile
	function totalProfile(){
	$query=$this->db->query("SELECT count(StudentNumber) as StudeCount FROM studeprofile");
	return $query->result();}
	
	
	//For payment verification count
	function forPaymentVerCount($sy,$sem){
	$query=$this->db->query("SELECT count(o.StudentNumber) as Studecount FROM online_payments o join studeprofile p on o.StudentNumber=p.StudentNumber where o.sy='".$sy."' and o.sem='".$sem."' and o.depositStat='For Verification'");
	return $query->result();}
	
	//First Year Counts
	function enrolledFirst($sy,$sem){
	$query=$this->db->query("SELECT count(StudentNumber) as StudeCount, SY, Semester, YearLevel, Course FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' and YearLevel='1st'");
	return $query->result();}
	
	//Second Year Counts
	function enrolledSecond($sy,$sem){
	$query=$this->db->query("SELECT count(StudentNumber) as StudeCount, SY, Semester, YearLevel, Course FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' and YearLevel='2nd'");
	return $query->result();}
	
	//Third Year Counts
	function enrolledThird($sy,$sem){
	$query=$this->db->query("SELECT count(StudentNumber) as StudeCount, SY, Semester, YearLevel, Course FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' and YearLevel='3rd'");
	return $query->result();}

	//Fourth Year Counts
	function enrolledFourth($sy,$sem){
	$query=$this->db->query("SELECT count(StudentNumber) as StudeCount, SY, Semester, YearLevel, Course FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' and YearLevel='4th'");
	return $query->result();}
	
	//Semester Enrollees
	function getEnrolled($course, $yearlevel)
	{
		$this->db->select('*');
		if($course)
		$this->db->where('Course', $course);
		if($yearlevel)
			$this->db->where('YearLevel', $yearlevel);
		$query = $this->db->get('semesterstude');
		return $query->result();
	}
	
	//Course Count Summary Per Semester
	function dailyEnrollStat()
	{
	$query=$this->db->query("SELECT Status, count(Status)as Counts FROM semesterstude where DAY(enroledDate)=DAY(NOW()) and MONTH(enroledDate)=MONTH(NOW()) and YEAR(enroledDate)=YEAR(NOW()) group by Status"); 
	return $query->result();
	}
	//Payment Summary Per Semester
	function paymentSummary($sem,$sy)
	{
	$query=$this->db->query("SELECT CollectionSource, sum(Amount) as Amount FROM paymentsaccounts where ORStatus='Valid' and Sem='".$sem."' and SY='".$sy."' group by CollectionSource");
	return $query->result();
	}
	//Birthday Celebrants
	function birthdayCelebs($sem,$sy)
	{
	$query=$this->db->query("SELECT concat(p.LastName,', ',p.FirstName,' ',p.MiddleName) as StudeName, p.BirthDate FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where DAY(p.BirthDate)=DAY(NOW()) and MONTH(p.BirthDate)=MONTH(NOW()) and ss.Semester='".$sem."' and ss.SY='".$sy."'");
	return $query->result();
	}
	//Birthday Celebrants
	function birthdayMonths($sem,$sy)
	{
	$query=$this->db->query("SELECT concat(p.LastName,', ',p.FirstName,' ',p.MiddleName) as StudeName, Day(p.BirthDate) as Day, MONTH(p.BirthDate) as Month FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where MONTH(p.BirthDate)=MONTH(NOW()) and ss.Semester='".$sem."' and ss.SY='".$sy."' order by Day");
	return $query->result();
	}
	
	//Quick Today's Collection
	function collectionToday()
	{
	$query=$this->db->query("SELECT sum(Amount) as Amount FROM paymentsaccounts where ORStatus='Valid' and DAY(PDate)=DAY(NOW()) and MONTH(PDate)=MONTH(NOW()) and YEAR(PDate)=YEAR(NOW())");
	return $query->result();
	}
	//Quick This Month's Collection
	function collectionMonth()
	{
	$query=$this->db->query("SELECT sum(Amount) as Amount FROM paymentsaccounts where ORStatus='Valid' and MONTH(PDate)=MONTH(NOW()) and YEAR(PDate)=YEAR(NOW())");
	return $query->result();
	}
	//Quick This Year's Collection
	function YearlyCollections()
	{
	$query=$this->db->query("SELECT sum(Amount) as Amount FROM paymentsaccounts where ORStatus='Valid' and YEAR(PDate)=YEAR(NOW())");
	return $query->result();
	}
	//Course Count Summary Per Semester
	function CourseCount($sem,$sy)
	{
	$query=$this->db->query("SELECT Course, count(Course) as Counts FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' group by Course");
	return $query->result();
	}

	//Sex Count Summary Per Semester
	function SexCount($sem,$sy)
	{
	$query=$this->db->query("SELECT p.Sex, count(p.Sex) as Counts FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' group by p.Sex");
	return $query->result();
	}
	//Sex Summary
	function sexList($sem,$sy,$sex)
	{
	$query=$this->db->query("SELECT p.StudentNumber, p.FirstName, p.MiddleName, p.LastName, ss.Course, ss.YearLevel, p.Sex FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' and p.Sex='".$sex."'");
	return $query->result();
	}
	
	//City List Summary
	function cityList($sem,$sy,$city)
	{
	$query=$this->db->query("SELECT p.StudentNumber, p.FirstName, p.MiddleName, p.LastName, ss.Course, ss.YearLevel, p.city FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' and p.city='".$city."' order by p.LastName");
	return $query->result();
	}

	//Ethnicity List Summary
	function ethnicityList($sem,$sy,$ethnicity)
	{
	$query=$this->db->query("SELECT p.StudentNumber, p.FirstName, p.MiddleName, p.LastName, ss.Course, ss.YearLevel, p.ethnicity FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' and p.ethnicity='".$ethnicity."' order by p.LastName");
	return $query->result();
	}
	
	//Religion List Summary
	function religionList($sem,$sy,$religion)
	{
	$query=$this->db->query("SELECT p.StudentNumber, p.FirstName, p.MiddleName, p.LastName, ss.Course, ss.YearLevel, p.Religion FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' and p.Religion='".$religion."' order by p.LastName");
	return $query->result();
	}
	//Count by Religion
	function religionCount($sem,$sy)
	{
	$query=$this->db->query("SELECT p.Religion, count(p.Religion) as Counts FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' group by p.Religion");
	return $query->result();
	}	
	//Count by Ethnicity
	function ethnicityCount($sem,$sy)
	{
	$query=$this->db->query("SELECT p.Ethnicity, count(p.Ethnicity) as Counts FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' group by p.Ethnicity");
	return $query->result();
	}
	//Count by City
	function cityCount($sem,$sy)
	{
	$query=$this->db->query("SELECT p.city, count(p.city) as Counts FROM studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.SY='".$sy."' and ss.Semester='".$sem."' group by p.city");
	return $query->result();
	}	
	//Student's List
	function getProfile()
	{
		$query=$this->db->query("select * from studeprofile order by LastName");
	return $query->result();
	}
	
	//Student's List
	function teachers()
	{
		$query=$this->db->query("select * from staff order by LastName");
	return $query->result();
	}
	
	//For Enrollment
	function forValidation($Semester,$SY)
	{
	$query=$this->db->query("select * from studeprofile p join online_enrollment oe on p.StudentNumber=oe.StudentNumber where oe.Semester='".$Semester."' and oe.SY='".$SY."' and oe.enrolStatus='For Validation'");
	return $query->result();
	}
	
	//get the latest semester and reflect it on the proof_payment
	function getSemesterfromOE($id)
	{
	$query=$this->db->query("select * from online_enrollment where StudentNumber='".$id."' order by oeID desc limit 1");
	return $query->result();
	}

	//Slot Monitoring
	function slotsMonitoring($sem,$sy)
	{
	$query=$this->db->query("select r.SubjectCode, r.Description, count(*) as Enrolled, r.Section, r.SchedTime, r.Instructor, r.Sem, r.SY from registration r where r.Sem='".$sem."' and r.SY='".$sy."' group by r.SubjectCode, r.Section, r.Instructor, r.SchedTime order by r.SubjectCode");
	return $query->result();
	}
	
	//Subject Masterlist
	function subjectMasterlist($sem,$sy,$subjectcode,$section)
	{
	$query=$this->db->query("select * from registration where Sem='".$sem."' and SY='".$sy."' and Section='".$section."' and subjectcode='".$subjectcode."' group by StudentNumber order by LastName");
	return $query->result();
	}
	
		
	//Grade
	function grades($sem,$sy)
	{
	$query=$this->db->query("select * from grades where Semester='".$sem."' and SY='".$sy."' group by SubjectCode, Section, Instructor order by SubjectCode");
	return $query->result();
	}
	//Grading Sheets
	function gradeSheets($sem, $sy, $SubjectCode, $Description, $Section)
	{
	$query=$this->db->query("select * from grades g join studeprofile p on g.StudentNumber=p.StudentNumber where g.Semester='".$sem."' and g.SY='".$sy."' and g.SubjectCode='".$SubjectCode."' and g.Section='".$Section."' order by p.LastName");
	return $query->result();
	}
	//CrossEnrollees
	function crossEnrollees($sem, $sy)
	{
	$query=$this->db->query("select concat(p.LastName,', ',p.FirstName,' ',p.MiddleName) as StudentName, ss.YearLevel, p.Sex, ss.Course, ss.classSession, ss.Semester, ss.SY  from studeprofile p join semesterstude ss on p.StudentNumber=ss.StudentNumber where ss.Status='Enrolled' and ss.crossEnrollee='Yes' and ss.Semester='".$sem."' and ss.SY='".$sy."' order by ss.LName");
	return $query->result();
	}
	
	//Admission History
	function admissionHistory($id)
	{
	$query=$this->db->query("select p.StudentNumber, concat(p.FirstName,' ',p.MiddleName,' ',p.LastName) as StudentName, s.Course, s.YearLevel, s.SY, s.Semester from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber join srms_settings st on p.settingsID=st.settingsID where p.StudentNumber='".$id."'");
	return $query->result();
	}

	//otherPaymentHistory
	function otherPaymentHistory($id)
	{
	$query=$this->db->query("SELECT * FROM paymentsaccounts where StudentNumber='".$id."' and ORStatus='Valid' and CollectionSource='Services'");
	return $query->result();
	}

	//Get Course and Display on the combo box
	function getCourse()
	{
		$this->db->select('CourseDescription');
		$this->db->distinct();
		$this->db->order_by('CourseDescription','ASC');
		$query = $this->db->get('course_table');
		return $query->result();
	}

	function getMajor($course)
	{
		$this->db->select('Major');
		$this->db->where('CourseDescription', $course);
		$this->db->distinct();
		$this->db->order_by('Major','ASC');
		$query = $this->db->get('course_table');
		return $query->result();
	}

	function getSection()
	{
		$this->db->select('Section');
		$this->db->distinct();
		$this->db->group_by('Section','ASC');
		$this->db->order_by('Section','ASC');
		$query = $this->db->get('sections');
		return $query->result();
	}	
	
	//update enrollees status
	function updateEnrollees($id)
	{
	$this->db->query("update online_enrollment set enrolStatus='Verified' where oeID='".$id."'");
	}

	//Masterlist by Grade Level
	function byGradeLevel($yearlevel, $semester, $sy)
	{
	$query=$this->db->query("select * from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber where s.YearLevel='".$yearlevel."' and s.Semester='".$semester."' and s.SY='".$sy."' and s.Status='Enrolled' order by p.LastName, p.Sex");
	return $query->result();
	}
	
	//Student Enrollment Status
	function studeEnrollStat($id, $sem, $sy)
	{
	$query=$this->db->query("select * from semesterstude where StudentNumber='".$id."' and Semester='".$sem."' and SY='".$sy."'");

	return $query->result();

        if($query->num_rows() > 0)
        {
           return $query->result();
        }
        return false;
	}
	//Student Current Balance
	function studeBalance($id)
	{
	//$query=$this->db->query("select * from studeaccount where StudentNumber='".$id."' and Sem='".$sem."' and SY='".$sy."'");
	$query=$this->db->query("select * from studeaccount where StudentNumber='".$id."' order by AccountID desc limit 1");

	return $query->result();

        if($query->num_rows() > 0)
        {
           return $query->result();
        }
        return false;
	}

	//Faculty Load Counts
	function facultyLoadCounts($id, $sem, $sy)
	{
	$query=$this->db->query("SELECT count(SubjectCode) as subjectCounts FROM semsubjects where IDNumber='".$id."' and Semester='".$sem."' and SY='".$sy."'");

	return $query->result();

        if($query->num_rows() > 0)
        {
           return $query->result();
        }
        return false;
	}

	//Faculty Grades
	function facultyGrades($instructor, $sem, $sy)
	{
	$query=$this->db->query("SELECT count(SubjectCode) as subjectCounts FROM grades where Instructor='".$instructor."' and Semester='".$sem."' and SY='".$sy."' group by SubjectCode");

	return $query->result();

        if($query->num_rows() > 0)
        {
           return $query->result();
        }
        return false;
	}
	
	//Student Total Enrolled Subjects
	function studeTotalSubjects($id, $sem, $sy)
	{
	$query=$this->db->query("SELECT count(SubjectCode) as subjectCounts FROM registration where StudentNumber='".$id."' and Sem='".$sem."' and SY='".$sy."'");

	return $query->result();

        if($query->num_rows() > 0)
        {
           return $query->result();
        }
        return false;
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
	
	//Statement of Account
	function studentStatement($id, $sem, $sy)
	{
	$query=$this->db->query("select * from studeaccount where StudentNumber='".$id."' and Sem='".$sem."' and SY='".$sy."' order by FeesDesc");
	return $query->result();
	}
	
	//Masterlist (All)
	function masterlistAll2($id, $semester, $sy)
	{
	$query=$this->db->query("select * from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber where s.semstudentid='".$id."' and s.Semester='".$semester."' and s.SY='".$sy."' and s.Status='Enrolled' order by p.LastName, p.Sex");
	return $query->result();
	}
	
	//Count Summary Per Year Level
	function byGradeLevelCount($yearlevel, $semester, $sy)
	{
	$query=$this->db->query("SELECT Course, count(Course) enrollees FROM semesterstude where YearLevel='".$yearlevel."' and Semester='".$semester."' and SY='".$sy."' and Status='Enrolled' group by Course");
	return $query->result();
	}
	
	//Masterlist by Course
	function byCourse($course, $sy, $sem)
	{
	$query=$this->db->query("select * from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber where s.SY='".$sy."' and s.Semester='".$sem."' and s.Status='Enrolled' and s.Course='".$course."' and s.Status='Enrolled' order by p.LastName, p.Sex");
	return $query->result();
	}
	
	//Enrollees Counts Per Course (Year Level Counts)
	function CourseYLCounts($course, $sy, $sem)
	{
	$query=$this->db->query("SELECT YearLevel, count(YearLevel) as yearLevelCounts FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' and Course='".$course."' group by YearLevel");
	return $query->result();
	}
	
	//Enrollees Counts Per Section (Year Level Counts)
	function SectionCounts($course, $sy, $sem)
	{
	$query=$this->db->query("SELECT Section, count(Section) as sectionCounts FROM semesterstude where SY='".$sy."' and Semester='".$sem."' and Status='Enrolled' and Course='".$course."' group by Section");
	return $query->result();
	}
	
	//Masterlist by Enrolled Online
	function byEnrolledOnline($department, $sy)
	{
	$query=$this->db->query("select * from studeprofile p join online_enrollment oe on p.StudentNumber=oe.StudentNumber where oe.SY='".$sy."' and oe.enrolStatus='Enrolled'");
	return $query->result();
	}

	//Masterlist by Enrolled Semester
	function byEnrolledOnlineSem($sem, $sy)
	{
	$query=$this->db->query("select * from studeprofile p join online_enrollment oe on p.StudentNumber=oe.StudentNumber where oe.Semester='".$sem."' and oe.SY='".$sy."' and oe.enrolStatus='Enrolled'");
	return $query->result();
	}
	
	//Masterlist by Enrolled Online (ALL)
	function byEnrolledOnlineAll()
	{
	$query=$this->db->query("select p.StudentNumber, concat(p.LastName,', ',p.FirstName,' ',p.MiddleName) as StudeName, oe.Course, oe.YearLevel, oe.enrolStatus, concat(oe.Semester,' ',oe.SY) as SY, oe.downPayment, oe.downPaymentStat  from studeprofile p join online_enrollment oe on p.StudentNumber=oe.StudentNumber order by p.LastName");
	return $query->result();
	}
	
	//Masterlist By Section
	function bySection($section, $semester, $sy)
	{
	$query=$this->db->query("select * from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber where s.Section='".$section."' and s.Semester='".$semester."' and s.SY='".$sy."' and s.Status='Enrolled' order by p.LastName, p.Sex");
	return $query->result();
	}
	
	//Masterlist by SY
	function bySY($sy,$sem)
	{
	$query=$this->db->query("select * from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber where s.SY='".$sy."' and s.Semester='".$sem."' and s.Status='Enrolled' group by p.StudentNumber order by p.LastName");
	return $query->result();
	}	
	
	//Masterlist by Date
	function byDate($date)
	{
	$query=$this->db->query("select * from studeprofile p join semesterstude s on p.StudentNumber=s.StudentNumber where s.enroledDate='".$date."' and s.Status='Enrolled' group by p.StudentNumber order by p.LastName");
	return $query->result();
	}	
    //Masterlist by Date Summary
	function byDateCourseSum($date)
	{
	$query=$this->db->query("SELECT Course, count(Course) as Enrollees FROM semesterstude where enroledDate='".$date."' and Status='Enrolled' group by Course order by Course");
	return $query->result();
	}	

    //ACCOUNTING REPORTS --------------------------------------------------------------------------
    function collectionReport($from, $to)
	{
	$query=$this->db->query("select PDate, ORNumber, Format(Amount,2) as Amount, description, StudentNumber, concat(LastName,', ',FirstName,' ',MiddleName) as Payor, Course, PaymentType, Description, CheckNumber, Bank, CollectionSource, concat(Sem,' ',SY) as Semester from paymentsaccounts where PDate>='".$from."' and PDate<='".$to."' and ORStatus='Valid' order by PDate desc");
	return $query->result();
	}

	function collectionTotal($from, $to)
	{
	$query=$this->db->query("select Sum(Amount) as TotalAmount from paymentsaccounts where PDate>='".$from."' and PDate<='".$to."' and ORStatus='Valid' order by PDate desc");
	return $query->result();
	}
	
	function collectionSummary($from, $to)
	{
	$query=$this->db->query("SELECT PaymentType, format(sum(Amount),2) as TotalAmount FROM paymentsaccounts where PDate>='".$from."' and PDate<='".$to."' and ORStatus='Valid' group by PaymentType");
	return $query->result();
	}

	function collectionTotalYear($year)
	{
	$query=$this->db->query("select Sum(Amount) as TotalAmount from paymentsaccounts where YEAR(PDate)='".$year."' and ORStatus='Valid' order by PDate desc");
	return $query->result();
	}

	function collectionYear($year)
	{
	$query=$this->db->query("SELECT PDate, ORNumber, Format(Amount,2) as Amount, description, StudentNumber, concat(LastName,', ',FirstName,' ',MiddleName) as Payor, Description, PaymentType, YEAR(PDate) FROM paymentsaccounts where YEAR(PDate)='".$year."' and ORStatus='Valid' order by PDate desc");
	return $query->result();
	}
	
	function studeAccounts($sem,$sy,$course,$yearlevel)
	{
	$query=$this->db->query("Select AccountID, StudentNumber, concat(LastName,', ',FirstName,' ',MiddleName) as StudentName, Course, format(AcctTotal,2) as AcctTotal, format(TotalPayments,2) as TotalPayments, format(Discount,2) as Discount, format(CurrentBalance,2) as CurrentBalance, YearLevel, Sem, SY FROM studeaccount where Sem='".$sem."' and SY='".$sy."' and YearLevel='".$yearlevel."' and Course= '".$course."' group by StudentNumber order by StudentName");
	return $query->result();
	}
	
	function studeAccountsWithBalance($sem,$sy,$course,$yearlevel)
	{
	$query=$this->db->query("Select AccountID, StudentNumber, concat(LastName,', ',FirstName,' ',MiddleName) as StudentName, Course, format(AcctTotal,2) as AcctTotal, format(TotalPayments,2) as TotalPayments, format(Discount,2) as Discount, format(CurrentBalance,2) as CurrentBalance, YearLevel, Sem, SY FROM studeaccount where Sem='".$sem."' and SY='".$sy."' and YearLevel='".$yearlevel."' and Course= '".$course."' and CurrentBalance>'0' group by StudentNumber order by StudentName");
	return $query->result();
	}	
	//PASSWORD ---------------------------------------------------------------------------------
	function is_current_password($username, $currentpass){
		$this->db->select();
		$this->db->from ('users');
		$this->db->where ('username',$username);
		$this->db->where ('password',$currentpass);
		$this->db->where ('acctStat','active');
	    $query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;}
		
	}

	function reset_userpassword($username, $newpass){
		$data= array(
		'password'=>$newpass
		);
		$this->db->where('username', $username);			
		 if($this->db->update('users', $data))
		 {return TRUE;}else {return FALSE;}
	}
	
//Get Profile Pictures
	 public function profilepic($id){
		 $this->db->select('*');
		 $this->db->from('o_users');
		 $this->db->where('username',$id);
		 $query=$this->db->get();
		 return $query->result();
	 }

	//Total Request
	function totalStudeRequest()
	{
	$query=$this->db->query("SELECT reqStat, count(reqStat) as requestCounts FROM stude_request");
	return $query->result();}

	//Open Request
	function openRequest()
	{
	$query=$this->db->query("SELECT reqStat, count(reqStat) as requestCounts FROM stude_request where reqStat='Open'");
	return $query->result();}

	//Open Request
	function closedRequest()
	{
	$query=$this->db->query("SELECT reqStat, count(reqStat) as requestCounts FROM stude_request where reqStat='Closed'");
	return $query->result();}

	//Student REQUEST
	function studeRequestList()
	{
	$query=$this->db->query("select * from stude_request sr join studeprofile p on sr.StudentNumber=p.StudentNumber where sr.reqStat='Open' order by trackingNo desc");
	return $query->result();
	}
	//Student REQUEST
	function closedDocRequest()
	{
	$query=$this->db->query("select * from stude_request sr join studeprofile p on sr.StudentNumber=p.StudentNumber where sr.reqStat='Closed' order by sr.dateReq desc");
	return $query->result();
	}
	
	//Student REQUEST
	function openDocRequest()
	{
	$query=$this->db->query("select * from stude_request sr join studeprofile p on sr.StudentNumber=p.StudentNumber where sr.reqStat='Open' order by sr.dateReq desc");
	return $query->result();
	}

//Student REQUEST
	function allDocRequest()
	{
	$query=$this->db->query("select * from stude_request sr join studeprofile p on sr.StudentNumber=p.StudentNumber order by sr.trackingNo desc");
	return $query->result();
	}
	
	function docReqCounts()
	{
	$query=$this->db->query("SELECT docName, count(docName) as docCounts FROM stude_request group by docName");
	return $query->result();
	}
	
}
