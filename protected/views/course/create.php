<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List Course','url'=>array('index')),
	array('label'=>'Manage Course','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Course') ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>