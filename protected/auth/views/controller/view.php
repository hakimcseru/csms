<?php
$this->breadcrumbs=array(
	'Auth Controllers'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List AuthController','url'=>array('index')),
array('label'=>'Create AuthController','url'=>array('create')),
array('label'=>'Update AuthController','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete AuthController','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AuthController','url'=>array('admin')),
);
?>

<h1>View AuthController #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'module_id',
		'name',
		'active',
),
)); ?>
