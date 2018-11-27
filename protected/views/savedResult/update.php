<?php
$this->breadcrumbs=array(
	'Saved Results'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SavedResult','url'=>array('index')),
	array('label'=>'Create SavedResult','url'=>array('create')),
	array('label'=>'View SavedResult','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SavedResult','url'=>array('admin')),
);
?>

<h1>Update SavedResult <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>