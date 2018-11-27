<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Groups')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List StudentCollectionGroup','url'=>array('index')),
	array('label'=>'Create StudentCollectionGroup','url'=>array('create')),
	array('label'=>'View StudentCollectionGroup','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentCollectionGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update Student Collection Group')?>#<?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>