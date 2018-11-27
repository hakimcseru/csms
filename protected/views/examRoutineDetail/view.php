<?php
$this->breadcrumbs=array(
	'Exam Routine Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExamRoutineDetail','url'=>array('index')),
	array('label'=>'Create ExamRoutineDetail','url'=>array('create')),
	array('label'=>'Update ExamRoutineDetail','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ExamRoutineDetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExamRoutineDetail','url'=>array('admin')),
);
?>

<h1>View ExamRoutineDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'faculty_member_id',
		'batch_section_id',
		'room_id',
		'exam_date_id',
		'additional_faculty_member_id',
		'course_id',
		'department_id',
		'batch_id',
		'batch_group_id',
		'weekday',
		'exam_routine_id',
		'semester_id',
		'subject_id',
	),
)); ?>
