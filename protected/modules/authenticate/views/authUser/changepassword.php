<?php
$this->breadcrumbs=array(
	'Auth Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AuthUser','url'=>array('index')),
	array('label'=>'Create AuthUser','url'=>array('create')),
	array('label'=>'View AuthUser','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AuthUser','url'=>array('admin')),
	);
	?>

	<h1>Change User Password - <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_changepassword_form',array('model'=>$model)); ?>