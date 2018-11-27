<?php
$this->breadcrumbs=array(
	'Course Subjects'=>array('index'),
	$model->course_subject_pk=>array('view','id'=>$model->course_subject_pk),
	'Update',
);

$this->menu=array(
	array('label'=>'List CourseSubject','url'=>array('index')),
	array('label'=>'Create CourseSubject','url'=>array('create')),
	array('label'=>'View CourseSubject','url'=>array('view','id'=>$model->course_subject_pk)),
	array('label'=>'Manage CourseSubject','url'=>array('admin')),
);
?>

<h1>Update CourseSubject <?php echo $model->course_subject_pk; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>