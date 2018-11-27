<?php
$this->breadcrumbs=array(
	'Notices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Notice','url'=>array('index')),
	array('label'=>'Create Notice','url'=>array('create')),
	array('label'=>'Update Notice','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Notice','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notice','url'=>array('admin')),
);
?>

<h1>View Notice #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'notice_title',
		'notice_description',
		'start_date',
		'end_date',
	),
)); ?>
