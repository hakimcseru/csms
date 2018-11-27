<?php
$this->breadcrumbs=array(
	'Class Periods'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClassPeriod','url'=>array('index')),
	array('label'=>'Create ClassPeriod','url'=>array('create')),
	array('label'=>'View ClassPeriod','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ClassPeriod','url'=>array('admin')),
);
?>

<h1>Update ClassPeriod <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>