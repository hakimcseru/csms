<?php
$this->breadcrumbs=array(
	'Exam Routine Dates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExamRoutineDate','url'=>array('index')),
	array('label'=>'Create ExamRoutineDate','url'=>array('create')),
	array('label'=>'Update ExamRoutineDate','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ExamRoutineDate','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExamRoutineDate','url'=>array('admin')),
);
?>

<h1>View ExamRoutineDate #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'exam_routine_id',
		'exam_date',
	),
)); ?>
