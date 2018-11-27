<?php
$this->breadcrumbs=array(
	Yii::t('core','Rooms')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Room','url'=>array('index')),
	array('label'=>'Manage Room','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Room') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>