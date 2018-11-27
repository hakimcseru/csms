<?php
$this->breadcrumbs=array(
	Yii::t('core','Section')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List BatchSection','url'=>array('index')),
	array('label'=>'Manage BatchSection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Section')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>