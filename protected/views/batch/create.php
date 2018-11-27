<?php
$this->breadcrumbs=array(
	Yii::t('core','Batch')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Batch','url'=>array('index')),
	array('label'=>'Manage Batch','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Add Batch');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>