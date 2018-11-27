<?php
$this->breadcrumbs=array(
	Yii::t('core','Class Routines')=>array('admin'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List ClassRoutine','url'=>array('index')),
	array('label'=>'Create ClassRoutine','url'=>array('create')),
	array('label'=>'Update ClassRoutine','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ClassRoutine','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClassRoutine','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Class Routine');?> #<?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'faculty_member_id',
		'batch_section_id',
		'room_id',
		'class_period_id',
		'additional_faculty_member_id',
		'course_id',
		'department_id',
		'batch_id',
		'batch_group_id',
	),
)); ?>
