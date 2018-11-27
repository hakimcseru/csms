<?php
$this->breadcrumbs=array(
	 Yii::t('core','Student Dues')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List StudentDues','url'=>array('index')),
	array('label'=>'Create StudentDues','url'=>array('create')),
	array('label'=>'Update StudentDues','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentDues','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentDues','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Student Dues')?> #<?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'student_pk',
		//'student_id',
		array(
			'name'=>'student.student_name',
			'type'=> 'html',
			'value'=> nl2br(Yii::t('core',$model->students->student_name)),
			),
		'collection_id',
		'due_amount',
		'session_id',
		'due_date',
		//'course_id',
		array(
			'name'=>'course.course_name',
			'type'=> 'html',
			'value'=> nl2br(Yii::t('core',$model->course->course_name)),
			),
		'year',
		'month',
		'comment',
	),
)); ?>
