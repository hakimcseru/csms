<?php
$this->breadcrumbs=array(
	'Class Models'=>array('index'),
	$model->class_pk,
);

$this->menu=array(
	array('label'=>'List ClassModel','url'=>array('index')),
	array('label'=>'Create ClassModel','url'=>array('create')),
	array('label'=>'Update ClassModel','url'=>array('update','id'=>$model->class_pk)),
	array('label'=>'Delete ClassModel','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->class_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClassModel','url'=>array('admin')),
);
?>

<h1>View ClassModel #<?php echo $model->class_pk; ?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'class_pk',
		'class_ref_room_pk',
		'class_ref_room_no',
		'class_start_date',
		'class_end_date',
		'class_start_time',
		'class_end_time',
		'class_status',
		'class_days_on_week',
		'class_ref_batch_pk',
		'class_ref_batch_id',
		'class_ref_subject_pk',
		'class_ref_subject_name',
		'class_semester',
	),
)); ?>
