<?php
$this->breadcrumbs=array(
	'Attendance Calendars'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List AttendanceCalendar','url'=>array('index')),
	array('label'=>'Create AttendanceCalendar','url'=>array('create')),
	array('label'=>'Update AttendanceCalendar','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AttendanceCalendar','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AttendanceCalendar','url'=>array('admin')),
);
?>

<h1>View AttendanceCalendar #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'type',
		'title',
		'note',
		'status',
	),
)); ?>
