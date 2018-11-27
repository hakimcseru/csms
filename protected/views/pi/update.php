<?php
$this->breadcrumbs=array(
	'Pis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pi','url'=>array('index')),
	array('label'=>'Create Pi','url'=>array('create')),
	array('label'=>'View Pi','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Pi','url'=>array('admin')),
);
?>

<h1>Update Pi <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>