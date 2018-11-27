<?php
$this->breadcrumbs=array(
	'Examsettings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Examsetting','url'=>array('index')),
	array('label'=>'Create Examsetting','url'=>array('create')),
	array('label'=>'View Examsetting','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Examsetting','url'=>array('admin')),
);
?>

<h1>Update Examsetting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>