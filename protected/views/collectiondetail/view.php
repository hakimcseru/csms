<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Details')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StudentCollectionDetail','url'=>array('index')),
	array('label'=>'Create StudentCollectionDetail','url'=>array('create')),
	array('label'=>'Update StudentCollectionDetail','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentCollectionDetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentCollectionDetail','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Student Collection Detail')?> #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		
		array(
			'name'=>'id',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->id)),
			),
		array(
			'name'=>'student.student_name',
			'type'=> 'html',
			'value'=> nl2br(Yii::t('core',$model->student->student_name)),
			),
		
		array(
			'name'=>'student_id',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->student_id)),
			),
		array(
			'name'=>'collection_amount',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->collection_amount)),
			),
		
		'comment',
		array(
			'name'=>'collection_date',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->collection_date)),
			),
		
		'collection_type',
		
		array(
			'name'=>'bank_id',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->bank->name)),
			),
			
		array(
			'name'=>'deposite_date',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->deposite_date)),
			),
		
		array(
			'name'=>'session_id',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->session_id)),
			),
		
		array(
			'name'=>'course_id',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->course->course_name)),
			),
		
		array(
			'name'=>'year',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->year)),
			),
		
		array(
			'name'=>'month',
			'type'=> 'html',
			'value'=> nl2br(Bndate::t($model->month)),
			),
		'collection_for',
	),
)); ?>
