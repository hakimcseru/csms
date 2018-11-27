<?php
$this->breadcrumbs=array(
	'Attendance Release Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AttendanceReleaseSetting','url'=>array('index')),
	array('label'=>'Create AttendanceReleaseSetting','url'=>array('create')),
	array('label'=>'Update AttendanceReleaseSetting','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AttendanceReleaseSetting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AttendanceReleaseSetting','url'=>array('admin')),
);
?>

<h1>View AttendanceReleaseSetting #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session',
		'course_id',
		'min_allendance',
	),
)); ?>
