<?php
$this->breadcrumbs=array(
	'Exam Routine Details',
);

$this->menu=array(
	array('label'=>'Create ExamRoutineDetail','url'=>array('create')),
	array('label'=>'Manage ExamRoutineDetail','url'=>array('admin')),
);
?>

<h1>Exam Routine Details</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
