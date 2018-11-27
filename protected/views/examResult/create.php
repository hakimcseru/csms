<?php
$this->breadcrumbs=array(
	'Exam Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ExamResult','url'=>array('index')),
	array('label'=>'Manage ExamResult','url'=>array('admin')),
);
?>

<h1>Create ExamResult</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>