<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Remaining')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List StudentRemaining','url'=>array('index')),
	array('label'=>'Create StudentRemaining','url'=>array('create')),
	array('label'=>'Update StudentRemaining','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentRemaining','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentRemaining','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Student Remaining')?> #<?php echo Bndate::t($model->id); ?></h1>

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
		'remaining_amount',
		'description',
	),
)); ?>
