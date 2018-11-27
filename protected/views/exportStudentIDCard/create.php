<?php
$this->breadcrumbs=array(
	Yii::t('core','Student')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Student','url'=>array('index')),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Export Student ID') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>