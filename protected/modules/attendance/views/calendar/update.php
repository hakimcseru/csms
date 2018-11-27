<?php
$this->breadcrumbs=array(
	'Attendance Calendars'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AttendanceCalendar','url'=>array('index')),
	array('label'=>'Create AttendanceCalendar','url'=>array('create')),
	array('label'=>'View AttendanceCalendar','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AttendanceCalendar','url'=>array('admin')),
);
?>

<h1>Update AttendanceCalendar <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_uform',array('model'=>$model)); ?>