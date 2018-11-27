<?php
$this->breadcrumbs=array(
	'Course Semester Lebels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CourseSemesterLebel','url'=>array('index')),
	array('label'=>'Manage CourseSemesterLebel','url'=>array('admin')),
);
?>

<h1>Create CourseSemesterLebel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>