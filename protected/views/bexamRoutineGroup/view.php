<?php
$this->breadcrumbs=array(
	'Bexam Routine Groups'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BexamRoutineGroup','url'=>array('index')),
	array('label'=>'Create BexamRoutineGroup','url'=>array('create')),
	array('label'=>'Update BexamRoutineGroup','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete BexamRoutineGroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BexamRoutineGroup','url'=>array('admin')),
);
?>

<h1>View BexamRoutineGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'batch_group_id',
		'group_name',
		'start_role',
		'end_role',
		'session_id',
		'course_id',
		'department_id',
		'batch_id',
	),
)); ?>
