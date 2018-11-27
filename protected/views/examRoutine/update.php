<?php
$this->breadcrumbs=array(
	'Exam Routines'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExamRoutine','url'=>array('index')),
	array('label'=>'Create ExamRoutine','url'=>array('create')),
	array('label'=>'View ExamRoutine','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ExamRoutine','url'=>array('admin')),
);
?>

<h1>Update ExamRoutine <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>