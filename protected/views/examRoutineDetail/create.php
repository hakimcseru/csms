<?php
$this->breadcrumbs=array(
	'Exam Routine Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExamRoutineDetail','url'=>array('index')),
	array('label'=>'Manage ExamRoutineDetail','url'=>array('admin')),
);
?>

<h1>Create ExamRoutineDetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>