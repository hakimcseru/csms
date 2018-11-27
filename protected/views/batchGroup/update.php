<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch Group')=>array('index'),
	Bndate::t($model->id)=>array('view','id'=>$model->id),
	Yii::t('core','Update'),
);

$this->menu=array(
	array('label'=>'List BatchGroup','url'=>array('index')),
	array('label'=>'Create BatchGroup','url'=>array('create')),
	array('label'=>'View BatchGroup','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BatchGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Update')." ".Yii::t('core','Batch Group');?> # <?php echo Bndate::t($model->id); ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>