<?php
$this->breadcrumbs=array(
	'Student Results'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentResult','url'=>array('index')),
	array('label'=>'Create StudentResult','url'=>array('create')),
	array('label'=>'View StudentResult','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentResult','url'=>array('admin')),
);
?>

<h1>Update StudentResult <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>