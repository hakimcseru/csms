<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Groups')=>array('index'),
	//Yii::t('core','Student Collection Groups')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List StudentCollectionGroup','url'=>array('index')),
	array('label'=>'Manage StudentCollectionGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Student Collection Group') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>