<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
		<!-- System Administrator -->
		<?php if($this->session->userdata('level')==='Admin'):?>
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url(); ?>Page/admin" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>
				<li>
                    <a href="#" class="waves-effect">
                        <i class="ion ion-md-add-circle "></i>
                        <span> Human Resource </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Page/hr">HR Dashboard</a></li>
						<li><a href="<?= base_url(); ?>Page/employeeList">Faculty and Staff</a></li>
                        <li><a href="#">Service Record</a></li>
                    </ul>
                </li>

				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-school"></i>
                        <span> Registrar </span>
                        <span class="menu-arrow"></span>
                    </a>
					
                    <ul class="nav-second-level nav" aria-expanded="false">
						<li><a href="<?= base_url(); ?>Page/registrar">Registrar Dashboard</a> </li>
                        <li><a href="<?= base_url(); ?>Page/profileList">Student's Profile</a> </li>
                        <li><a href="<?= base_url(); ?>Masterlist/enrolledList">Enrollment</a></li>
                        <li><a href="<?= base_url(); ?>page/forValidation">Online Enrollees <small style="color:red;">[for action]</small></a></li>
						<li><a href="<?= base_url(); ?>Masterlist/deniedEnrollees">Online Enrollees (Denied)</a></li>
						<li>
                            <a href="#" aria-expanded="false">Masterlist
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="<?= base_url(); ?>Masterlist/dailyEnrollees">Enrollees By Date</a></li>
								<li><a href="<?= base_url(); ?>Page/masterlistByCourseFiltered">By Course</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/bySY">By Semester</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/subregistration">By Subject</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/byEnrolledOnlineSem?sy=<?php echo $this->session->userdata('sy');?>&sem=<?php echo $this->session->userdata('semester');?>">Online Enrollees (By Sem)</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/byEnrolledOnlineAll">Online Enrollees (All)</a></li>
							</ul>
						</li>
						<li>
                            <a href="#" aria-expanded="false">Reports
                                    <span class="menu-arrow"></span>
                                </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="<?= base_url(); ?>Masterlist/slotsMonitoring">Slots Monitoring</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/grades">Grading Sheets</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/gradesSummary">Grades Summary</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/crossEnrollees">List of Cross-Enrollees</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/fteRecords">FTE Records</a></li>
								<li><a href="<?= base_url(); ?>er.php" target="_blank">Enrollment Report</a></li>
								<li><a href="<?= base_url(); ?>pr.php" target="_blank">Promotional Report</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
				
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-paper"></i>
                        <span> Accounting </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level nav" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Page/accounting">Accounting Dashboard</a></li>
						<li><a href="<?= base_url(); ?>Page/proof_payment_view">Payment Verification</a></li>
                        <li><a href="<?= base_url(); ?>Accounting/collectionReport">Collection Report</a></li>
                        <li><a href="<?= base_url(); ?>Accounting/collectionYear">Collection Per Year</a></li>
                        <li><a href="<?= base_url(); ?>Accounting/studeAccounts">Student's Accounts</a></li>
                        <li><a href="<?= base_url(); ?>Page/onlinePaymentsAll">Online Payments (All)</a></li>
						<li><a href="<?= base_url(); ?>Page/deniedPayments">Online Payments (Denied)</a></li>
						<li><a href="<?= base_url(); ?>Accounting/studeAccountsWithBalance">Students With Outstanding Balance</a></li>
                        <li><a href="<?= base_url(); ?>Accounting/accountingStudeReports">Student's Reports</a></li>
						<li><a href="<?= base_url(); ?>Page/voidORs">List of VOID ORs</a></li>
                    </ul>
                </li>
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-square-outline"></i>
                        <span> Alumni </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level nav" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Alumni/">Alumni Dashboard</a></li>
						<li>
                            <a href="#" aria-expanded="false">Graduates
                                    <span class="menu-arrow"></span>
                                </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="<?= base_url(); ?>Alumni/alumniAll">All</a></li>
								<li><a href="<?= base_url(); ?>Alumni/alumniBatch">By Batch</a></li>
								
                            </ul>
                        </li>
                        
                        <li><a href="<?= base_url(); ?>Alumni/selfEmployed">Self-Employed</a></li>   
                    </ul>
                </li>
				<!--
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-address-book"></i>
                        <span> Library </span>
                        <span class="menu-arrow"></span>
                    </a>
					
                    <ul class="nav-second-level nav" aria-expanded="false">
						<li><a href="<?= base_url(); ?>Page/library">Librarian Dashboard</a> </li>
                        <li><a href="<?= base_url(); ?>Library/Books">Cataloging</a></li>
						<li>
                            <a href="#" aria-expanded="false">Circulation
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="<?= base_url(); ?>Library/borrow">Borrow</a></li>
								<li><a href="<?= base_url(); ?>Library/returnbooks">Return</a></li>
							</ul>
						</li>
						<li>
                            <a href="#" aria-expanded="false">Settings
                                    <span class="menu-arrow"></span>
                                </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="<?= base_url(); ?>Library/author">Author</a></li>
								<li><a href="<?= base_url(); ?>Library/category">Category</a></li>
								<li><a href="<?= base_url(); ?>Library/location">Location</a></li>
								<li><a href="<?= base_url(); ?>Library/publisher">Publisher</a></li>
                            </ul>
                        </li>
						<li>
                            <a href="#" aria-expanded="false">Reports
                                    <span class="menu-arrow"></span>
                                </a>
                            <ul class="nav-third-level nav" aria-expanded="false">
                                <li><a href="<?= base_url(); ?>Library/reportsAllBooks">All Books</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>-->
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-archive"></i>
                        <span> Document Request </span>
                        <span class="menu-arrow"></span>
                    </a>
					
                    <ul class="nav-second-level nav" aria-expanded="false">
						<li><a href="<?= base_url(); ?>Page/newRequest">Add New</a></li>	
						<li><a href="<?= base_url(); ?>Page/allRequest">All Request</a></li>
						<li><a href="<?= base_url(); ?>Page/requestSummary">Summary</a></li>						
                    </ul>
                </li>
				
				 <li class="menu-title">Administration</li> 
				 <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-cloud-upload"></i>
                        <span> Upload </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>FileUploader/">Students' Profile</a></li>
                        <li><a href="<?= base_url(); ?>import">Students' Profile v2</a></li>
                        <li><a href="<?= base_url(); ?>FileUploader/teachers">Faculty and Staff</a></li>
                        <li><a href="<?= base_url(); ?>FileUploader/Courses">Courses</a></li>
                        <!--<li><a href="<?= base_url(); ?>FileUploader/courseFees">Course Fees</a></li>-->
                        <li><a href="<?= base_url(); ?>FileUploader/sections">Sections</a></li>
                        <li><a href="<?= base_url(); ?>FileUploader/subjects">Subjects</a></li>
                    </ul>
                </li>
				<li>
                    <a href="<?= base_url() ?>Settings/Department" class="waves-effect">
                        <i class="ion ion-md-checkmark"></i>
                        <span> Courses </span>
                    </a>
                </li>
				<li>
                    <a href="<?= base_url() ?>Settings/Sections" class="waves-effect">
                        <i class="ion ion-md-folder-open"></i>
                        <span> Sections </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-contacts "></i>
                        <span> User Accounts </span>
                         <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Page/createAccount">Create an Account</a></li>
						<li><a href="<?= base_url(); ?>Page/viewAccounts">Reset an Account</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/announcement?id=<?php echo $this->session->userdata('username');?>" class="waves-effect">
                        <i class="ion-md-map"></i>
                        <span> Announcement </span>
                    </a>
                </li>

                <!--
				<li>
                    <a href="<?= base_url(); ?>Student/downloads" class="waves-effect">
                        <i class="ion ion-md-cloud-download"></i>
                        <span> Resources </span>
                    </a>  
                </li> -->
                <li>
                    <a href="<?= base_url(); ?>Page/changepassword" class="waves-effect">
                        <i class=" ion ion-ios-key"></i>
                        <span> Change Password </span>
                    </a>
                </li>
				 <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-settings"></i>
                        <span> Settings </span>
                         <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Settings/schoolInfo">School Information</a></li>
						<li><a href="<?= base_url(); ?>Settings/loginFormBanner">Login Page Image</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->
		
		<?php elseif($this->session->userdata('level')==='Registrar'):?>
			<div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url(); ?>Page/registrar" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class=" ion ion-md-school"></i>
                        <span> Admission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Page/profileList">Student's Profile</a> </li>
                        <li><a href="<?= base_url(); ?>Masterlist/enrolledList">Enrollment</a></li>
                        <li><a href="<?= base_url(); ?>page/forValidation">Online Enrollees <small style="color:red;">[for action]</small></a></li>
                      
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-list-box"></i>
                        <span> Masterlist </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Masterlist/dailyEnrollees">Enrollees By Date</a></li>
                        <li><a href="<?= base_url(); ?>Page/masterlistByCourseFiltered">By Course</a></li>
                        <li><a href="<?= base_url(); ?>Masterlist/bySY">By Semester</a></li>
						<li><a href="<?= base_url(); ?>Masterlist/subregistration">By Subject</a></li>
                        <li><a href="<?= base_url(); ?>Masterlist/byEnrolledOnlineSem?sy=<?php echo $this->session->userdata('sy');?>&sem=<?php echo $this->session->userdata('semester');?>">Online Enrollees (By Sem)</a></li>
                        <li><a href="<?= base_url(); ?>Masterlist/byEnrolledOnlineAll">Online Enrollees (All)</a></li>
                    </ul>
                </li>
				 <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-list-box"></i>
                        <span> Reports </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Masterlist/slotsMonitoring">Slots Monitoring</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/grades">Grading Sheets</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/gradesSummary">Grades Summary</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/crossEnrollees">List of Cross-Enrollees</a></li>
								<li><a href="<?= base_url(); ?>Masterlist/fteRecords">FTE Records</a></li>
                    </ul>
                </li>
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-archive"></i>
                        <span> Document Request </span>
                        <span class="menu-arrow"></span>
                    </a>
					
                    <ul class="nav-second-level nav" aria-expanded="false">
						<li><a href="<?= base_url(); ?>Page/newRequest">Add New</a></li>	
						<li><a href="<?= base_url(); ?>Page/allRequest">All Request</a></li>
						<li><a href="<?= base_url(); ?>Page/requestSummary">Summary</a></li>						
                    </ul>
                </li>
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class=" ion ion-md-settings"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Settings/Department">Course</a></li>
                        <li><a href="<?= base_url(); ?>Settings/Sections">Sections</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/studeDirectory" class="waves-effect">
                        <i class="ion ion-md-phone-landscape"></i>
                        <span> Contacts Directory </span>
                    </a>  
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/changepassword" class="waves-effect">
                        <i class=" ion ion-ios-key"></i>
                        <span> Change Password </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->
		
		<?php elseif($this->session->userdata('level')==='Accounting'):?>
		        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url(); ?>Page/accounting" class="waves-effect">
                        <i class="ion ion-md-home"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>

				<li>
                    <a href="<?= base_url(); ?>Page/proof_payment_view" class="waves-effect">
                        <i class=" ion ion-md-checkmark-circle"></i>
                        <span> Payment Verification </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>Accounting/collectionReport" class="waves-effect">
                        <i class="ion ion-md-business"></i>
                        <span> Collection Report </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>Accounting/collectionYear" class="waves-effect">
                        <i class=" ion ion-md-document"></i>
                        <span> Collection Per Year </span>
                    </a>  
                </li>
				
				<li>
                    <a href="<?= base_url(); ?>Accounting/studeAccounts" class="waves-effect">
                        <i class="ion ion-md-calculator"></i>
                        <span> Students' Accounts </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>Page/onlinePaymentsAll" class="waves-effect">
                        <i class="ion ion-md-filing"></i>
                        <span> Online Payments (All) </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>Accounting/studeAccountsWithBalance" class="waves-effect">
                        <i class=" ion ion-md-checkbox-outline"></i>
                        <span> Students With Balance </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>Accounting/accountingStudeReports" class="waves-effect">
                        <i class="ion ion-md-folder"></i>
                        <span> Students' Reports </span>
                    </a>  
                </li>
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-archive"></i>
                        <span> Document Request </span>
                        <span class="menu-arrow"></span>
                    </a>
					
                    <ul class="nav-second-level nav" aria-expanded="false">
						<li><a href="<?= base_url(); ?>Page/newRequest">Add New</a></li>	
						<li><a href="<?= base_url(); ?>Page/allRequest">All Request</a></li>
						<li><a href="<?= base_url(); ?>Page/requestSummary">Summary</a></li>						
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url(); ?>Page/studeDirectory" class="waves-effect">
                        <i class="fas fa-mobile-alt"></i>
                        <span> Contacts Directory </span>
                    </a>  
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/changepassword" class="waves-effect">
                        <i class=" ion ion-ios-key"></i>
                        <span> Change Password </span>
                    </a>
                </li>
            </ul>

        </div>
		
		<?php elseif($this->session->userdata('level')==='Student'):?>
		        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url(); ?>Page/student" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/studentsprofile" class="waves-effect">
                        <i class="ion ion-md-contact "></i>
                        <span>  My Profile  </span>
                    </a> 
                </li>
			
				<!--
                <li>
                    <a href="<?= base_url(); ?>Page/enrollment" class="waves-effect">
                        <i class="ion ion-md-checkbox-outline"></i>
                        <span> Enrollment </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/uploadrequirements" class="waves-effect">
                        <i class="ion ion-md-folder"></i>
                        <span> Requirements </span>
                    </a>  
                </li>
				
				<li>
                    <a href="<?= base_url(); ?>Page/proof_payment" class="waves-effect">
                        <i class=" ion ion-md-filing "></i>
                        <span> Proof of Payment </span>
                    </a>  
                </li>
        -->
				<li>
                    <a href="<?= base_url(); ?>Masterlist/COR" class="waves-effect">
                        <i class=" ion ion-ios-list-box"></i>
                        <span> Enrolled Subjects </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>Accounting/studentStatement" class="waves-effect">
                        <i class=" ion ion-ios-desktop "></i>
                        <span> Statement of Account </span>
                    </a>  
                </li>
                <li>
                    <a href="<?= base_url(); ?>Page/studeaccount" class="waves-effect">
                        <i class=" ion ion-ios-desktop "></i>
                        <span> Account Tracking </span>
                    </a>  
                </li>
				<li>
                    <a href="<?= base_url(); ?>stude_grades.php?view=<?php echo $this->session->userdata('username');?>" onClick="return popup(this, 'notes')" class="waves-effect">
                    <!--<a href="<?= base_url(); ?>Masterlist/studeGradesView?studeno=<?php echo $this->session->userdata('username');?>" class="waves-effect">-->
                        <i class="ion ion-md-school"></i>
                        <span> Grades </span>
                    </a>  
                </li>
            </ul>

            <SCRIPT TYPE="text/javascript">
  function popup(mylink, windowname) { 
    if (! window.focus)return true;
    var href;
    if (typeof(mylink) == 'string') href=mylink;
    else href=mylink.href; 
    window.open(href, windowname, 'width=1200,height=1000,resizable=yes,scrollbars=0,toolbar=0,menubar=0,location=0,directories=0,channelmode=0,titlebar=no,addressbar=0, status=0'); 
    return false; 
  }
</SCRIPT>


        </div>
		
		<?php elseif($this->session->userdata('level')==='Instructor'):?>
		        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url(); ?>Page/instructor" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>Instructor/facultyLoad?id=<?php echo $this->session->userdata('username');?>" class="waves-effect">
                        <i class="ion ion-md-contact "></i>
                        <span>  Faculty Load  </span>
                    </a> 
                </li>
				<li>
                    <a href="#" class="waves-effect">
                        <i class="mdi mdi-file-document-box-search"></i>
                        <span> 201 Files  </span>
                    </a> 
                </li>
                <li>
                    <a href="<?= base_url(); ?>Page/changepassword" class="waves-effect">
                        <i class=" ion ion-ios-key"></i>
                        <span> Change Password </span>
                    </a>
                </li>
            </ul>
		</div>
		<?php elseif($this->session->userdata('level')==='Librarian'):?>
		        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?= base_url(); ?>Page/library" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  Dashboard  </span>
                    </a>
                </li>
						


						<li>
							<a href="<?= base_url(); ?>Library/Books" class="waves-effect">
								<i class=" ion ion-ios-document"></i>
								<span>  Cataloging  </span>
							</a> 
						</li>
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class=" ion ion-ios-photos"></i>
                        <span>  Circulation  </span>
						<span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= base_url(); ?>Library/borrow">Borrow</a></li>
						<li><a href="<?= base_url(); ?>Library/returnbooks">Return</a></li>
                    </ul>
                </li>
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class=" ion ion-md-settings"></i>
                        <span>  Settings  </span>
						<span class="menu-arrow"></span>
                    </a>
						<ul class="nav-second-level" aria-expanded="false">
						   <li><a href="<?= base_url(); ?>Library/author">Author</a></li>
								<li><a href="<?= base_url(); ?>Library/category">Category</a></li>
								<li><a href="<?= base_url(); ?>Library/location">Location</a></li>
								<li><a href="<?= base_url(); ?>Library/publisher">Publisher</a></li>
                    </ul>
                </li>	
				<li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class=" ion ion-ios-paper"></i>
                        <span>  Reports  </span>
						<span class="menu-arrow"></span>
                    </a>
						<ul class="nav-second-level" aria-expanded="false">
						   <li><a href="<?= base_url(); ?>Library/reportsAllBooks">All Books</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url(); ?>Page/changepassword" class="waves-effect">
                        <i class=" ion ion-ios-key"></i>
                        <span> Change Password </span>
                    </a>
                </li>
            </ul>
        </div>
		<?php endif;?>
		
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>