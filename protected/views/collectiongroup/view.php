<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Groups')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List StudentCollectionGroup','url'=>array('index')),
	array('label'=>'Create StudentCollectionGroup','url'=>array('create')),
	array('label'=>'Update StudentCollectionGroup','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentCollectionGroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentCollectionGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Student Collection Group')?> #<?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'group_name',
		'active',
	),
)); ?>
