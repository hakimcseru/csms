<?php
$this->breadcrumbs=array(
	'Saved Results'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SavedResult','url'=>array('index')),
	array('label'=>'Create SavedResult','url'=>array('create')),
	array('label'=>'Update SavedResult','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SavedResult','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SavedResult','url'=>array('admin')),
);
?>

<h1>View SavedResult #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'course',
		'department',
		'semester',
		'batch_group',
		'course_id',
		'department_id',
		'semester_id',
		'batch_group_id',
		'roll_no',
		'name',
		'student_id',
		'total_number',
		'result',
		'position',
		'published_date',
		'saved_date',
		'saved_by',
	),
)); ?>
