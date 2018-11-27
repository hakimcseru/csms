<?php
$this->breadcrumbs=array(
	'Class Models'=>array('index'),
	$model->class_pk=>array('view','id'=>$model->class_pk),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClassModel','url'=>array('index')),
	array('label'=>'Create ClassModel','url'=>array('create')),
	array('label'=>'View ClassModel','url'=>array('view','id'=>$model->class_pk)),
	array('label'=>'Manage ClassModel','url'=>array('admin')),
);
?>

<h1>Update ClassModel <?php echo $model->class_pk; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>