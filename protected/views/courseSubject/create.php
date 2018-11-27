<?php
$this->breadcrumbs=array(
	'Course Subjects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CourseSubject','url'=>array('index')),
	array('label'=>'Manage CourseSubject','url'=>array('admin')),
);
?>

<h1>Create CourseSubject</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>