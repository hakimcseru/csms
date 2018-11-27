<?php
$this->breadcrumbs=array(
	'Attendance Final Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AttendanceFinalData','url'=>array('index')),
	array('label'=>'Create AttendanceFinalData','url'=>array('create')),
	array('label'=>'Update AttendanceFinalData','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AttendanceFinalData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AttendanceFinalData','url'=>array('admin')),
);
?>

<h1>View AttendanceFinalData #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'core_employee_id',
		'core_employee_name',
		'core_shift_id',
		'core_shift_name',
		'core_department_id',
		'core_department_name',
		'date',
		'status',
		'in_time',
		'break_start',
		'break_end',
		'out_time',
		'work_hour',
		'over_time',
		'note',
		'json_log',
	),
)); ?>
