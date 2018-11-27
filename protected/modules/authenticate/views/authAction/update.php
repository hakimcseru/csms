<?php
$this->breadcrumbs=array(
	'Auth Actions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AuthAction','url'=>array('index')),
	array('label'=>'Create AuthAction','url'=>array('create')),
	array('label'=>'View AuthAction','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AuthAction','url'=>array('admin')),
	);
	?>

	<h1>Update AuthAction <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>