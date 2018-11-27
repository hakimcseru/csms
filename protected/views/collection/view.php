<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collections')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List StudentCollection','url'=>array('index')),
	array('label'=>'Create StudentCollection','url'=>array('create')),
	array('label'=>'Update StudentCollection','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentCollection','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentCollection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Student Collection')?> #<?php echo Bndate::t($model->id); ?></h1>

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
		'collection_amount',
		'comment',
		'collection_date',
		'collection_type',
		//'bank_id',
		array('name'=>'bank_id','value'=>$model->bank_id?$model->bankinfo->name:null),
		'deposite_date',
		'session_id',
		//'course_id',
		array('name'=>'course_id','value'=>$model->course_id?$model->course->course_name:null),
	),
)); ?>
