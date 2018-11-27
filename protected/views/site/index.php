<?php $this->renderPartial('_menu'); ?>
<ul class="thumbnails">
  <li class="span3">
	  <a href="<?php echo Yii::app()->createUrl('student/manage'); ?>" class="thumbnail" data-title='Student Management' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/student-128x128.png" alt="">
	  <h4 style="text-align: center;"> <?php echo Yii::t('core', 'Student')?></h4>
    </a>
  </li>
  <li class="span3">
    <a href="#" class="thumbnail" data-title='Student Attendance' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/student-attendance-128x128.png" alt="">
	  <h4 style="text-align: center;">Student Attendance</h4>
    </a>
  </li>
  <li class="span3">
    <a href="#" class="thumbnail" data-title='Exam Management' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/exam-128x128.png" alt="">
	  <h4 style="text-align: center;">Exams &AMP; Results</h4>
    </a>
  </li>
  <li class="span3">
    <a href="http://hasan.drikict.net/erp" class="thumbnail" data-title='Faculty Attendance' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/meeting-128x128.png" alt="">
	  <h4 style="text-align: center;">Workshop &amp; Meeting</h4>
    </a>
  </li>

</ul>
<ul class="thumbnails">
  <li class="span3">
    <a href="#" class="thumbnail" data-title='Faculty Management' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/faculty-128x128.png" alt="">
	  <h4 style="text-align: center;">Faculty</h4>
    </a>
  </li>
  <li class="span3">
    <a href="http://hasan.drikict.net/erp" class="thumbnail" data-title='Faculty Attendance' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/faculty-attendance-128x128.png" alt="">
	  <h4 style="text-align: center;">Faculty Attendance</h4>
    </a>
  </li>
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('course/admin'); ?>" class="thumbnail" data-title='Course Management' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/course-128x128.png" alt="">
	  <h4 style="text-align: center;">Course</h4>
    </a>
  </li>
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('batch/admin'); ?>" class="thumbnail" data-title='Batch Management' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/batch-128x128.png" alt="">
	  <h4 style="text-align: center;">Batch</h4>
    </a>
  </li>

</ul>
<ul class="thumbnails">
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('subject/admin'); ?>" class="thumbnail" data-title='Course Management' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/subject-128x128.png" alt="">
	  <h4 style="text-align: center;">Subject</h4>
    </a>
  </li>
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('room/index'); ?>" class="thumbnail" data-title='Room Management' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/room-128x128.png" alt="">
	  <h4 style="text-align: center;">Room</h4>
    </a>
  </li>
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('calendar/index'); ?>" class="thumbnail" data-title='Schedule Calendar' data-content='Add/update/delete faculty members, assign faculty on class etc.' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/calendar-128x128.png" alt="">
	  <h4 style="text-align: center;">Schedule</h4>
    </a>
  </li>
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('contactManager/manage'); ?>" class="thumbnail" data-title='Contact Management' data-content='View and manage contact' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/contact-128x128.png" alt="">
	  <h4 style="text-align: center;">Contact</h4>
    </a>
  </li>
</ul>
<ul class="thumbnails">
	<li class="span3">
    <a href="#" class="thumbnail" data-title='Accounts Management' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/accounts-128x128.png" alt="">
	  <h4 style="text-align: center;">Accounts</h4>
    </a>
  </li>
  <li class="span3">
    <a href="<?php echo Yii::app()->createUrl('certificateRecord/admin'); ?>" class="thumbnail" data-title='Certificate Record' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/certificate-128x128.png" alt="">
	  <h4 style="text-align: center;">Certificate</h4>
    </a>
  </li>
  <li class="span3">
    <a href="#" class="thumbnail" data-title='Documents Management' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/documents-128x128.png" alt="">
	  <h4 style="text-align: center;">Documents</h4>
    </a>
  </li>
  <li class="span3">
    <a href="#" class="thumbnail" data-title='Noticeboard' data-content='Addmission, search,  update and all others functionality related to students' rel='popover'>
      <img src="<?php echo Yii::app()->baseUrl;?>/images/icons/notice-128x128.png" alt="">
	  <h4 style="text-align: center;">Notice</h4>
    </a>
  </li>
</ul>