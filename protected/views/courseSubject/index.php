<?php
$this->breadcrumbs=array(
	'Course Subjects',
);

$this->menu=array(
	array('label'=>'Create CourseSubject','url'=>array('create')),
	array('label'=>'Manage CourseSubject','url'=>array('admin')),
);
?>

<h1>Course Subjects</h1>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
