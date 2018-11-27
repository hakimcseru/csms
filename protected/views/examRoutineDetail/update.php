<?php
$this->breadcrumbs=array(
	'Exam Routine Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExamRoutineDetail','url'=>array('index')),
	array('label'=>'Create ExamRoutineDetail','url'=>array('create')),
	array('label'=>'View ExamRoutineDetail','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ExamRoutineDetail','url'=>array('admin')),
);
?>

<h1>Update ExamRoutineDetail <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>