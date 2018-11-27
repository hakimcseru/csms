<?php
$this->breadcrumbs=array(
	'Auth User Roles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AuthUserRole','url'=>array('index')),
	array('label'=>'Create AuthUserRole','url'=>array('create')),
	array('label'=>'View AuthUserRole','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AuthUserRole','url'=>array('admin')),
	);
	?>

	<h1>Update AuthUserRole <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>