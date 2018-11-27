<?php
$this->breadcrumbs=array(
	'Course Subjects'=>array('index'),
	$model->course_subject_pk,
);

$this->menu=array(
	array('label'=>'List CourseSubject','url'=>array('index')),
	array('label'=>'Create CourseSubject','url'=>array('create')),
	array('label'=>'Update CourseSubject','url'=>array('update','id'=>$model->course_subject_pk)),
	array('label'=>'Delete CourseSubject','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->course_subject_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseSubject','url'=>array('admin')),
);
?>

<h1>View CourseSubject #<?php echo $model->course_subject_pk; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'course_subject_pk',
		'course_subject_ref_course_pk',
		'course_subject_ref_subject_pk',
		'course_subject_semester_no',
	),
)); ?>
