<?php
$this->breadcrumbs=array(
	Yii::t('core','Collection Heads')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List CollectionHead','url'=>array('index')),
	array('label'=>'Create CollectionHead','url'=>array('create')),
	array('label'=>'Update CollectionHead','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CollectionHead','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CollectionHead','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Collection Head')?> #<?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        //'head_group_id',
		array(
			'name'=>'head_group.head_group_id',
			'type'=> 'html',
			'value'=> nl2br(Yii::t('core',$model->head_group->group_name)),
			),
		'session',
		//'course',
		array(
			'name'=>'coursee.course',
			'type'=> 'html',
			'value'=> nl2br(Yii::t('core',$model->coursee?$model->coursee->course_name:"")),
			),
		
		
		'student_type',
		'apply_on_month',
		'collection_amount',
		'purpose',
		'active',
	),
)); ?>
