<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Materials')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List CourseMaterial','url'=>array('index')),
	array('label'=>'Create CourseMaterial','url'=>array('create')),
	array('label'=>'Update CourseMaterial','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CourseMaterial','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseMaterial','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Course Materials')?> #<?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'doc_title',
		'doc_description',
		'session_id',
		'course_id',
		'semester_id',
		'department_id',
		'subject_id',
		'group_id',
		'file_location',
	),
)); ?>
