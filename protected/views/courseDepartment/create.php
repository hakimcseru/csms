<?php
$this->breadcrumbs=array(
	Yii::t('core','Course')."-".Yii::t('core','Department')=>array('index'),
	Yii::t('core','Create'),
);

$this->menu=array(
	array('label'=>'List CourseDepartment','url'=>array('index')),
	array('label'=>'Manage CourseDepartment','url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('core','Course')."-".Yii::t('core','Department');?> <?php echo Yii::t('core','Create');?> </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>