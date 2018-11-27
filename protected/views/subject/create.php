<?php
$this->breadcrumbs=array(
	Yii::t('core','Subject')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Subject','url'=>array('index')),
	array('label'=>'Manage Subject','url'=>array('admin')),
);
?>

<h1><?php echo  Yii::t('core','Subject')." ".Yii::t('core','Create');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>