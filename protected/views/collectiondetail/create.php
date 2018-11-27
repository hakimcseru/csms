<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Details')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List StudentCollectionDetail','url'=>array('index')),
	array('label'=>'Manage StudentCollectionDetail','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Student Collection Details')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>