<?php
$this->breadcrumbs=array(
	'Exam Results'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExamResult','url'=>array('index')),
	array('label'=>'Create ExamResult','url'=>array('create')),
	array('label'=>'Update ExamResult','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ExamResult','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExamResult','url'=>array('admin')),
);
?>

<h1>View ExamResult #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session',
		'start_limit',
		'end_limit',
		'result',
	),
)); ?>
