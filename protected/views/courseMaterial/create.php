<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Materials')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List CourseMaterial','url'=>array('index')),
	array('label'=>'Manage CourseMaterial','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Create Course Materials')?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>