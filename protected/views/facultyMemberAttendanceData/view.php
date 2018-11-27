<?php
$this->breadcrumbs=array(
	'Faculty Member Attendance Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FacultyMemberAttendanceData','url'=>array('index')),
	array('label'=>'Create FacultyMemberAttendanceData','url'=>array('create')),
	array('label'=>'Update FacultyMemberAttendanceData','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FacultyMemberAttendanceData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacultyMemberAttendanceData','url'=>array('admin')),
);
?>

<h1>View FacultyMemberAttendanceData #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'member_id',
		'fm_reg_no',
		'date',
		'time',
		'mode',
		'note',
	),
)); ?>
