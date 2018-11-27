<?php
$this->breadcrumbs=array(
	'Account Processes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AccountProcess','url'=>array('index')),
	array('label'=>'Create AccountProcess','url'=>array('create')),
	array('label'=>'View AccountProcess','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AccountProcess','url'=>array('admin')),
);
?>

<h1>Update AccountProcess <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>