<?php
$this->breadcrumbs=array(
	Yii::t('core','Department')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Department','url'=>array('index')),
	array('label'=>'Manage Department','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Department') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>