<?php
$this->breadcrumbs=array(
	Yii::t('core','Collection Heads')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List CollectionHead','url'=>array('index')),
	array('label'=>'Create CollectionHead','url'=>array('create')),
	array('label'=>'View CollectionHead','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CollectionHead','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Collection Heads') ?>#<?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>