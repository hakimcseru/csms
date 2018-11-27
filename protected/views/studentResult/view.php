<?php
$this->breadcrumbs=array(
	'Student Results'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StudentResult','url'=>array('index')),
	array('label'=>'Create StudentResult','url'=>array('create')),
	array('label'=>'Update StudentResult','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentResult','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentResult','url'=>array('admin')),
);
?>

<h1>View StudentResult #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session',
		'course',
		'department',
		'subject',
		'student_pk',
		'student_id',
		'full_marks',
		'result',
		'semester',
		'batch_id',
		'batch_group',
	),
)); ?>
