<?php
$this->breadcrumbs=array(
	'Result Setings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ResultSetings','url'=>array('index')),
	array('label'=>'Create ResultSetings','url'=>array('create')),
	array('label'=>'Update ResultSetings','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ResultSetings','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ResultSetings','url'=>array('admin')),
);
?>

<h1>View ResultSetings #<?php echo $model->id; ?></h1>

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
