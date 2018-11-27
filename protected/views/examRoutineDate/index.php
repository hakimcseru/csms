<?php
$this->breadcrumbs=array(
	'Exam Routine Dates',
);

$this->menu=array(
	array('label'=>'Create ExamRoutineDate','url'=>array('create')),
	array('label'=>'Manage ExamRoutineDate','url'=>array('admin')),
);
?>

<h1>Exam Routine Dates</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
