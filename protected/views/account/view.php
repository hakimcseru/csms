<?php
$this->breadcrumbs=array(
	'Account Processes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AccountProcess','url'=>array('index')),
	array('label'=>'Create AccountProcess','url'=>array('create')),
	array('label'=>'Update AccountProcess','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AccountProcess','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AccountProcess','url'=>array('admin')),
);
?>

<h1>View AccountProcess #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'month',
		'year',
		'process_date',
		'process_status',
		'lock',
	),
)); ?>
