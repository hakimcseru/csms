<?php
$this->breadcrumbs=array(
	'Attendance Calendars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AttendanceCalendar','url'=>array('index')),
	array('label'=>'Manage AttendanceCalendar','url'=>array('admin')),
);
?>

<h1>Create AttendanceCalendar</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>