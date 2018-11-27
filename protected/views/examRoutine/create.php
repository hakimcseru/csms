<?php
$this->breadcrumbs=array(
	'Exam Routines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExamRoutine','url'=>array('index')),
	array('label'=>'Manage ExamRoutine','url'=>array('admin')),
);
?>

<h1>Create ExamRoutine</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>