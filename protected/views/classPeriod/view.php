<?php
$this->breadcrumbs=array(
	'Class Periods'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ClassPeriod','url'=>array('index')),
	array('label'=>'Create ClassPeriod','url'=>array('create')),
	array('label'=>'Update ClassPeriod','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ClassPeriod','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClassPeriod','url'=>array('admin')),
);
?>

<h1>View ClassPeriod #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'week_day',
		'start_time',
		'end_time',
	),
)); ?>
