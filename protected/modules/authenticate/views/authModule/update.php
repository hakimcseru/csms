<?php
$this->breadcrumbs=array(
	'Auth Modules'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AuthModule','url'=>array('index')),
	array('label'=>'Create AuthModule','url'=>array('create')),
	array('label'=>'View AuthModule','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AuthModule','url'=>array('admin')),
	);
	?>

	<h1>Update AuthModule <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>