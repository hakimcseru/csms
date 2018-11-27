<?php
$this->breadcrumbs=array(
	'Student Attendance Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StudentAttendanceData','url'=>array('index')),
	array('label'=>'Create StudentAttendanceData','url'=>array('create')),
	array('label'=>'Update StudentAttendanceData','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentAttendanceData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentAttendanceData','url'=>array('admin')),
);
?>

<h1>View StudentAttendanceData #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'student_id',
		'student_id'=>array('name'=>'student_id','value'=>Bndate::t($model->student->student_name)),
		'student_reg_no',
		'date',
		'time',
		'mode',
		'note',
	),
)); ?>
