<?php
$this->breadcrumbs=array(
	'Exam Routines'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ExamRoutine','url'=>array('index')),
	array('label'=>'Create ExamRoutine','url'=>array('create')),
	array('label'=>'Update ExamRoutine','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ExamRoutine','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExamRoutine','url'=>array('admin')),
);
?>

<h1>View ExamRoutine #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'name',
	),
)); ?>
