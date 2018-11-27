<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Faculty','url'=>array('index')),
	array('label'=>'Manage Faculty','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Faculty') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>