<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch')=>array('index'),
	Bndate::t($model->batch_pk)=>array('view','id'=>$model->batch_pk),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List Batch','url'=>array('index')),
	array('label'=>'Create Batch','url'=>array('create')),
	array('label'=>'View Batch','url'=>array('view','id'=>$model->batch_pk)),
	array('label'=>'Manage Batch','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update'); echo " ".Yii::t('core','Batch');?> <?php echo Bndate::t($model->batch_pk); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,'group'=>$group)); ?>