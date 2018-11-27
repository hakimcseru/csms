<?php
$this->breadcrumbs=array(
	Yii::t('core','Calendar')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Calendar','url'=>array('index')),
	array('label'=>'Manage Calendar','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Calendar') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>