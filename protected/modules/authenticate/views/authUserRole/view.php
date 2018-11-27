<?php
$this->breadcrumbs=array(
	'Auth User Roles'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List AuthUserRole','url'=>array('index')),
array('label'=>'Create AuthUserRole','url'=>array('create')),
array('label'=>'Update AuthUserRole','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete AuthUserRole','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage AuthUserRole','url'=>array('admin')),
);
?>

<h1>View AuthUserRole #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'active',
),
)); ?>
