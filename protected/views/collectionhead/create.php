<?php
$this->breadcrumbs=array(
	Yii::t('core','Manage Collection Heads')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List CollectionHead','url'=>array('index')),
	array('label'=>'Manage CollectionHead','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Collection Head') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>