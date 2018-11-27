<?php $this->beginContent('//layouts/main'); ?>
<div class="span3 well">
	<?php $this->widget('bootstrap.widgets.BootMenu', array(
    'type'=>'list',
    'items'=>array(
		array('label'=>Yii::t('core','Student, Faculty')),
		array('label'=>Yii::t('core','Quick Add New Student'),'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/qcreate')),
		array('label'=>Yii::t('core','Re Exam'),'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/examres')),
		
		array('label'=>Yii::t('core','ReNew Student'),'visible'=>!Yii::app()->user->isGuest, 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/rqcreate')),
		array('label'=>Yii::t('core','Enrollment Information'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentEnrollmentInfo/admin')),
		//array('label'=>Yii::t('core','Add New Student'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('student/create')),
		array('label'=>Yii::t('core','Manage Students'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('student/manage')),
		array('label'=>Yii::t('core','Students Communication'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentEnrollmentInfo/communication')),
                
		
		array('label'=>Yii::t('core','Exams & Results'), 'icon'=>'bookmark', 'url'=>Yii::app()->createUrl('#')),
		array('label'=>Yii::t('core','Workshop & Meeting'), 'icon'=>'bookmark', 'url'=>Yii::app()->createUrl('#')),
		array('label'=>Yii::t('core','Add New Faculty'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('faculty/create')),
		array('label'=>Yii::t('core','Manage Faculties'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('faculty/admin')),

		array('label'=>Yii::t('core','Add New Faculty Member'), 'icon'=>'user', 'url'=>Yii::app()->createUrl('facultyMember/create')),
		array('label'=>Yii::t('core','Manage Faculty Members'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('facultyMember/admin')),
		array('label'=>Yii::t('core','Course, Batch, Subject, Department')),
		array('label'=>Yii::t('core','Create New Course'), 'icon'=>'play', 'url'=>Yii::app()->createUrl('course/create')),
		array('label'=>Yii::t('core','Manage Courses'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('course/admin')),
		array('label'=>Yii::t('core','Add New Department'), 'icon'=>'book', 'url'=>Yii::app()->createUrl('department/create')),
		array('label'=>Yii::t('core','Manage Department'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('department/admin')),

		array('label'=>Yii::t('core','New Course Department'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseDepartment/create')),

		array('label'=>Yii::t('core','Manage Course Department'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseDepartment/admin')),

		array('label'=>Yii::t('core','Add New Batch'), 'icon'=>'bookmark', 'url'=>Yii::app()->createUrl('batch/create')),
		array('label'=>Yii::t('core','Manage Batches'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('batch/admin')),
		array('label'=>Yii::t('core','Add New Subject'), 'icon'=>'book', 'url'=>Yii::app()->createUrl('subject/create')),
		array('label'=>Yii::t('core','Manage Subjects'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('subject/admin')),

		array('label'=>Yii::t('core','Manage Course Semester Lebel'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseSemesterLebel/admin')),
		array('label'=>Yii::t('core','Manage Batch Group'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('batchGroup/admin')),
		array('label'=>Yii::t('core','Manage Section'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('batchSection/admin')),

		//array('label'=>Yii::t('core','Manage Course Subject'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseSubject/admin')),

		array('label'=>Yii::t('core','ID Card')),
		array('label'=>Yii::t('core','Generate Student ID'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('studentIDCard/create')),
		array('label'=>Yii::t('core','Export Student ID'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('exportStudentIDCard/create')),
		
		array('label'=>Yii::t('core','Teacher ID'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('facultyMember/index')),
		
		
		
		
		
		array('label'=>Yii::t('core','Room, Schedule')),
		array('label'=>Yii::t('core','Add New Task'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('calendar/create')),
		array('label'=>Yii::t('core','Manage Tasks'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('calendar/admin')),
		array('label'=>Yii::t('core','View Schedule'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('calendar/index')),
		array('label'=>Yii::t('core','Add New Room'), 'icon'=>'stop', 'url'=>Yii::app()->createUrl('room/create')),
		array('label'=>Yii::t('core','Manage Room'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('room/index')),
		array('label'=>Yii::t('core','Manage Calendar'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('calendarInfo/admin')),
		array('label'=>Yii::t('core','Manage Class Routine'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('classRoutine/index')),
		array('label'=>Yii::t('core','Manage Class Period'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('classPeriod/admin')),
		
		array('label'=>Yii::t('core','Print Class Routine'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('classRoutine/print')),
		
        array('label'=>Yii::t('core','Attendance, Schedule')),
		
		
		array('label'=>Yii::t('core','Calendar'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('attendance/calendar/index')),
		
		array('label'=>Yii::t('core','New Students Attendances'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('studentAttendanceData/index')),
		array('label'=>Yii::t('core','Students Attendances'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('studentAttendanceData/admin')),
		array('label'=>Yii::t('core','Students Attendances Report'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('classRoutine/studentAttendance')),
		array('label'=>Yii::t('core','Faculties Attendances'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/admin')),
		array('label'=>Yii::t('core','Faculties Attendances Report'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/index')),
		
		
		
		
		/*
        array('label'=>Yii::t('core','View Student Attendance'), 'icon'=>'search', 'url'=>Yii::app()->createUrl(                            'studentAttendanceData/studentattendance')),
        array('label'=>Yii::t('core','View Faculty Member Attendance'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/facultyattendance')),
        array('label'=>Yii::t('core','View Faculty Member Attendance Friday'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/facultymemberattendance')),
		array('label'=>Yii::t('core','View Detail Faculty Member Attendance'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('facultyMemberAttendanceData/detailattendance')),
		array('label'=>Yii::t('core','Day Wise Routine'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('calendarInfo/day')),
		array('label'=>Yii::t('core','View Room Time'), 'icon'=>'search', 'url'=>Yii::app()->createUrl('room/dayone')),
		*/
		
		array('label'=>Yii::t('core','Examination')),
		
		array('label'=>Yii::t('core','Attendance Release Setting'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('attendanceReleaseSetting/admin')),
		array('label'=>Yii::t('core','Admit Card'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('studentIDCardList/list')),
		array('label'=>Yii::t('core','New Exam Setting '), 'icon'=>'check', 'url'=>Yii::app()->createUrl('examsetting/create')),
		array('label'=>Yii::t('core','Manage Exam Setting'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('examsetting/admin')),
		array('label'=>Yii::t('core','New Result Setting'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('resultSetings/create')),
		array('label'=>Yii::t('core','Manage Result Setting'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('resultSetings/admin')),
		
		array('label'=>Yii::t('core','Exam Routine Group'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('bexamRoutineGroup/admin')),
		
		array('label'=>Yii::t('core','Exam Routine Date'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutineDate/admin')),
		
		array('label'=>Yii::t('core','Exam Routine'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutine/admin')),
		
		array('label'=>Yii::t('core','Exam Routine Set'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutine/index')),
		array('label'=>Yii::t('core','Exam Routine Print'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examRoutine/print')),
		array('label'=>Yii::t('core','Tabulation'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('examsetting/tabulation')),
		
		array('label'=>Yii::t('core','Saved Result'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('savedResult/admin')),
		
		array('label'=>Yii::t('core','Saved Result 2'), 'icon'=>'calendar', 'url'=>Yii::app()->createUrl('savedResult/admin2')),
		
		
		
		
                array('label'=>Yii::t('core','Accounts')),
		array('label'=>Yii::t('core','Collection'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('collection/create')),
                array('label'=>Yii::t('core','New Collection Head Group'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('collectiongroup/create')),
		array('label'=>Yii::t('core','Manage Collection Head Group'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collectiongroup/admin')),
		
                array('label'=>Yii::t('core','New Collection Head'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('collectionhead/create')),
		array('label'=>Yii::t('core','Manage Collection Head'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collectionhead/admin')),
		
		array('label'=>Yii::t('core','Collection Detail'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collectiondetail/admin')),
		array('label'=>Yii::t('core','Student Collections'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collection/admin')),
		array('label'=>Yii::t('core','Dues'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('dues/admin')),
		array('label'=>Yii::t('core','Remaining'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('remaining/admin')),
		array('label'=>Yii::t('core','Fine'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentFine/admin')),
		array('label'=>Yii::t('core','remission'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('collection/remission')),
		
		array('label'=>Yii::t('core','Account Clearance'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('studentAccountClearance/list')),
		array('label'=>Yii::t('core','Start nFirst Process'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('account/firstProcess/1420')),
        array('label'=>Yii::t('core','Auth Module Create'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authModule/create')),
		array('label'=>Yii::t('core','Manage Auth Module'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authModule/admin')),
		array('label'=>Yii::t('core','Auth Action Create'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authAction/create')),
		array('label'=>Yii::t('core','Manage Auth Action'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authAction/admin')),
		array('label'=>Yii::t('core','Auth Controller Create'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authController/create')),
		array('label'=>Yii::t('core','Manage Auth Controller'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authController/admin')),
		array('label'=>Yii::t('core','Auth User Create'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUser/create')),
		array('label'=>Yii::t('core','Manage Auth User'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUser/admin')),
		array('label'=>Yii::t('core','Auth User Role Create'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUserRole/create')),
		array('label'=>Yii::t('core','Manage Auth User Role'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUserRole/admin')),
		array('label'=>Yii::t('core','Auth User Role Access Create'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUserRoleAccess/create')),
		array('label'=>Yii::t('core','Manage Auth User Role Access'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('authenticate/authUserRoleAccess/admin')),
		
		
		
        array('label'=>'Reports'),
		array('label'=>Yii::t('core','Bank Wise Deposit Account Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary')),
		array('label'=>Yii::t('core','Date Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/depositDatewise')),
		array('label'=>Yii::t('core','Collection Head Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/collectionHeadWise')),
		array('label'=>Yii::t('core','Session Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/sessionwise')),
		array('label'=>Yii::t('core','Course Wise Deposit Reports'), 'icon'=>'check', 'url'=>Yii::app()->createUrl('reports/accountssummary/coursewise')),
		
		
        
                array('label'=>Yii::t('core','Others')),
		array('label'=>Yii::t('core','Add New Contact'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('contactManager/create')),
		array('label'=>Yii::t('core','Manage Contacts'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('contactManager/manage')),
		array('label'=>Yii::t('core','Accounts System'), 'icon'=>'file', 'url'=>Yii::app()->createUrl('#')),
		array('label'=>Yii::t('core','New Certificate Record'), 'icon'=>'tag', 'url'=>Yii::app()->createUrl('certificateRecord/create')),
		array('label'=>Yii::t('core','Manage Certificate Records'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('certificateRecord/admin')),
		array('label'=>Yii::t('core','Create Course Materials'), 'icon'=>'file', 'url'=>Yii::app()->createUrl('courseMaterial/create')),
		array('label'=>Yii::t('core','Manage Course Materials'), 'icon'=>'list', 'url'=>Yii::app()->createUrl('courseMaterial/admin')),
		array('label'=>Yii::t('core','Noticeboard'), 'icon'=>'file', 'url'=>Yii::app()->createUrl('notice/admin')),
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
