<?php
$this->breadcrumbs=array(
	'Auth Actions'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List AuthAction','url'=>array('index')),
array('label'=>'Create AuthAction','url'=>array('create')),
array('label'=>'Update AuthAction','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete AuthAction','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AuthAction','url'=>array('admin')),
);
?>

<h1>View AuthAction #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'module_id',
		'controller_id',
		'name',
		'active',
),
)); ?>
