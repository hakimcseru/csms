<?php
$this->breadcrumbs=array(
	'Auth Controllers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AuthController','url'=>array('index')),
	array('label'=>'Create AuthController','url'=>array('create')),
	array('label'=>'View AuthController','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AuthController','url'=>array('admin')),
	);
	?>

	<h1>Update AuthController <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>