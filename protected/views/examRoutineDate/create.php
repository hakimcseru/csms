<?php
$this->breadcrumbs=array(
	'Exam Routine Dates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExamRoutineDate','url'=>array('index')),
	array('label'=>'Manage ExamRoutineDate','url'=>array('admin')),
);
?>

<h1>Create ExamRoutineDate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>