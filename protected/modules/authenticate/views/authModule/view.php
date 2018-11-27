<?php
$this->breadcrumbs=array(
	'Auth Modules'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List AuthModule','url'=>array('index')),
array('label'=>'Create AuthModule','url'=>array('create')),
array('label'=>'Update AuthModule','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete AuthModule','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AuthModule','url'=>array('admin')),
);
?>

<h1>View AuthModule #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'active',
),
)); ?>
