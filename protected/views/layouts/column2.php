<?php $this->beginContent('//layouts/main'); ?>
<div class="span3 well">
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
		array('label'=>Yii::t('core','Student, Faculty')),
		array('label'=>Yii::t('core','Quick Add New Student'),'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/qcreate')),
		array('label'=>Yii::t('core','শিক্ষার্থী নবায়ন '),'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/rqcreate')),
		array('label'=>Yii::t('core','Re Exam'),'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/examres')),
		
		
		array('label'=>Yii::t('core','Enrollment Information'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentEnrollmentInfo/admin')),
		//array('label'=>Yii::t('core','Add New Student'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/create')),
		array('label'=>Yii::t('core','Manage Students'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('student/manage')),
		array('label'=>Yii::t('core','Students Communication'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentEnrollmentInfo/communication')),
		array('label'=>Yii::t('core','Export Student ID'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('exportStudentIDCard/create')),
		//array('label'=>Yii::t('core','Add New Faculty Member'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('facultyMember/create')),
		array('label'=>Yii::t('core','Manage Faculty Members'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('facultyMember/admin')),
		
		
		array('label'=>Yii::t('core','পরিচয়পত্র')),
		array('label'=>Yii::t('core','Generate Student ID'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('studentIDCard/create')),
		array('label'=>Yii::t('core','Teacher ID'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('facultyMember/index')),
		
				array('label'=>Yii::t('core','Room, Schedule')),
//		array('label'=>Yii::t('core','View Schedule'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('calendar/index')),
		//array('label'=>Yii::t('core','Add New Room'), 'icon'=>'stop', 'url'=>Yii::app()->createUrl('room/create')),
		array('label'=>Yii::t('core','Manage Room'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('room/index')),
				array('label'=>Yii::t('core','Manage Class Period'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('classPeriod/admin')),
				
				array('label'=>Yii::t('core','ছুটির তালিকা'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('attendance/calendar/index')),
		array('label'=>Yii::t('core','Manage Calendar'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('calendarInfo/admin')),
		array('label'=>Yii::t('core','Manage Class Routine'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('classRoutine/index')),
		array('label'=>Yii::t('core','Print Class Routine'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('classRoutine/print')),
		
		
		
		
		
		
		
		
		
		
        array('label'=>Yii::t('core','Attendance')),
		
		
		
		
		array('label'=>Yii::t('core','New Students Attendances'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('studentAttendanceData/index')),
		array('label'=>Yii::t('core','শিক্ষার্থী উপস্থিতি উপাত্ত'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('studentAttendanceData/admin')),
		array('label'=>Yii::t('core','Students Attendances Report'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('classRoutine/studentAttendance')),
		array('label'=>Yii::t('core','শিক্ষক উপস্থিতি উপাত্ত'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/admin')),
		array('label'=>Yii::t('core','Faculties Attendances Report'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/index')),
		
		
		array('label'=>Yii::t('core','পরীক্ষা ও ফলাফল')),
		
		array('label'=>Yii::t('core','ন্যূনতম উপস্থিতি নির্ধারণ'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('attendanceReleaseSetting/admin')),
		array('label'=>Yii::t('core','Admit Card'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('studentIDCardList/list')),
		array('label'=>Yii::t('core','পরীক্ষার বিষয় নির্ধারণ'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('examsetting/admin')),
		
				array('label'=>Yii::t('core','পরীক্ষার তারিখ'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutineDate/admin')),

		array('label'=>Yii::t('core','পরীক্ষার দল'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('bexamRoutineGroup/admin')),

		array('label'=>Yii::t('core','পরীক্ষাসূচি ব্যবস্থাপনা'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutine/admin')),
array('label'=>Yii::t('core','পরীক্ষাসূচি বিন্যাস'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutine/index')),
		array('label'=>Yii::t('core','পরীক্ষাসূচি মুদ্রণ'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutine/print')),

		//array('label'=>Yii::t('core','New Exam Setting '), 'icon'=>'check', 'url'=>Yii::app()->createUrl('examsetting/create')),
		//array('label'=>Yii::t('core','New Result Setting'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('resultSetings/create')),
		array('label'=>Yii::t('core','পরীক্ষার ফল নির্ধারক ব্যবস্থাপনা'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('resultSetings/admin')),
		
		
		
		
		array('label'=>Yii::t('core','মূল্যায়ন-সারণী '), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examsetting/tabulation')),
		array('label'=>Yii::t('core','সংরক্ষিত মূল্যায়ন-সারণী '), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('savedResult/admin')),
		array('label'=>Yii::t('core','সংরক্ষিত মূল্যায়নপত্র '), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('savedResult/admin2')),
		

		
	                array('label'=>Yii::t('core','Accounts')),
		array('label'=>Yii::t('core','Collection'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('collection/create')),
               // array('label'=>Yii::t('core','New Collection Head Group'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('collectiongroup/create')),
		array('label'=>Yii::t('core','Manage Collection Head Group'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collectiongroup/admin')),
		
                //array('label'=>Yii::t('core','New Collection Head'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('collectionhead/create')),
		array('label'=>Yii::t('core','Manage Collection Head'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collectionhead/admin')),
		
		array('label'=>Yii::t('core','Collection Detail'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collectiondetail/admin')),
		array('label'=>Yii::t('core','Student Collections'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collection/admin')),
		array('label'=>Yii::t('core','Dues'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('dues/admin')),
		array('label'=>Yii::t('core','Remaining'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('remaining/admin')),
		array('label'=>Yii::t('core','Fine'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentFine/admin')),
		array('label'=>Yii::t('core','remission'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collection/remission')),
		
		array('label'=>Yii::t('core','Account Clearance'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentAccountClearance/list')),
		//array('label'=>Yii::t('core','Start nFirst Process'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('account/firstProcess/1420')),
	
		
		array('label'=>Yii::t('core','Bank Wise Deposit Account Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary')),
		array('label'=>Yii::t('core','Date Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/depositDatewise')),
		array('label'=>Yii::t('core','Collection Head Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/collectionHeadWise')),
		array('label'=>Yii::t('core','Session Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/sessionwise')),
		array('label'=>Yii::t('core','Course Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/coursewise')),
		
		
		
		
		
		
		
		
		
		
		array('label'=>Yii::t('core','প্রাতিষ্ঠানিক বিন্যাস')),
		array('label'=>Yii::t('core','Manage Faculties'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('faculty/admin')),
		array('label'=>Yii::t('core','Manage Courses'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('course/admin')),
		array('label'=>Yii::t('core','Manage Department'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('department/admin')),
		array('label'=>Yii::t('core','Manage Course Department'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseDepartment/admin')),
		array('label'=>Yii::t('core','Manage Subjects'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('subject/admin')),
		array('label'=>Yii::t('core','Manage Course Semester Lebel'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseSemesterLebel/admin')),
		array('label'=>Yii::t('core','Manage Batches'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('batch/admin')),
		
		array('label'=>Yii::t('core','Manage Batch Group'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('batchGroup/admin')),
		array('label'=>Yii::t('core','Manage Section'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('batchSection/admin')),

		//array('label'=>Yii::t('core','Manage Course Subject'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseSubject/admin')),

		
		
		
		

		
		
		
		
		/*
        array('label'=>Yii::t('core','View Student Attendance'), 'icon'=>'search', 'url'=>Yii::app()->createUrl(                            'studentAttendanceData/studentattendance')),
        array('label'=>Yii::t('core','View Faculty Member Attendance'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/facultyattendance')),
        array('label'=>Yii::t('core','View Faculty Member Attendance Friday'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/facultymemberattendance')),
		array('label'=>Yii::t('core','View Detail Faculty Member Attendance'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/detailattendance')),
		array('label'=>Yii::t('core','Day Wise Routine'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('calendarInfo/day')),
		array('label'=>Yii::t('core','View Room Time'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('room/dayone')),
		*/
		
		
		
		

		
		
		
	    array('label'=>Yii::t('core','অন্যান্য')),
	
		
		array('label'=>Yii::t('core','Manage Course Materials'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseMaterial/admin')),	
		
		
        
                array('label'=>Yii::t('core','ব্যবহারকারিক অনুমোদন')),

				array('label'=>Yii::t('core','Module'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authModule/admin')),
				array('label'=>Yii::t('core','Controller'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authController/admin')),
		array('label'=>Yii::t('core','Action'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authAction/admin')),
		array('label'=>Yii::t('core','User'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUser/admin')),
		array('label'=>Yii::t('core','User Role'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUserRole/admin')),
		array('label'=>Yii::t('core','User Role Access'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUserRoleAccess/admin')),
		
    ),
)); ?>
</div>
<div class="span9 well main">
	<!-- <div class="row-fluid">-->
		<?php
		if(isset($this->breadcrumbs))
		{
			$this->widget('bootstrap.widgets.BootBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				//'htmlOptions'=>array('class'=>'bredcrumbs'),
			));

		}
		?>
	<!-- </div> -->
	<?php echo $content ?>
</div>
<?php $this->endContent(); ?>
