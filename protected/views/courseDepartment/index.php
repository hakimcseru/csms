<?php
$this->breadcrumbs=array(
	'Course Departments',
);

$this->menu=array(
	array('label'=>'Create CourseDepartment','url'=>array('create')),
	array('label'=>'Manage CourseDepartment','url'=>array('admin')),
);
?>

<h1>Course Departments</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
