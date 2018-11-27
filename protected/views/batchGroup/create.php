<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch Group')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List BatchGroup','url'=>array('index')),
	array('label'=>'Manage BatchGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Batch Group');?> <?php echo Yii::t('core','Create');?> </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>