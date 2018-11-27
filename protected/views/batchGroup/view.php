<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch Group')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List BatchGroup','url'=>array('index')),
	array('label'=>'Create BatchGroup','url'=>array('create')),
	array('label'=>'Update BatchGroup','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete BatchGroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BatchGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Batch Group');?> <?php echo Yii::t('core','View');?> # <?php echo Bndate::t($model->id); ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		
		array('name'=>'id','value'=>Bndate::t($model->id)),
		array('name'=>'batch_id','value'=>$model->batch->batch_id),

		'group_name',
	),
)); ?>
