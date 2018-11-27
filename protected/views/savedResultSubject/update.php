<?php
$this->breadcrumbs=array(
	'Saved Result Subjects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SavedResultSubject','url'=>array('index')),
	array('label'=>'Create SavedResultSubject','url'=>array('create')),
	array('label'=>'View SavedResultSubject','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SavedResultSubject','url'=>array('admin')),
);
?>

<h1>Update SavedResultSubject <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>