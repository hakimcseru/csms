<?php
$this->breadcrumbs=array(
	'Exam Routine Dates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ExamRoutineDate','url'=>array('index')),
	array('label'=>'Create ExamRoutineDate','url'=>array('create')),
	array('label'=>'View ExamRoutineDate','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ExamRoutineDate','url'=>array('admin')),
);
?>

<h1>Update ExamRoutineDate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>