<?php
$this->breadcrumbs=array(
	'Saved Result Subjects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SavedResultSubject','url'=>array('index')),
	array('label'=>'Create SavedResultSubject','url'=>array('create')),
	array('label'=>'Update SavedResultSubject','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete SavedResultSubject','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SavedResultSubject','url'=>array('admin')),
);
?>

<h1>View SavedResultSubject #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'saved_result_id',
		'subject_id',
		'subject_code',
		'subject_name',
		'subject_full_mark',
		'student_subject_marks',
	),
)); ?>
