<?php
$this->breadcrumbs=array(
	Yii::t('core','Course Materials'),
);

$this->menu=array(
	array('label'=>'Create CourseMaterial','url'=>array('create')),
	array('label'=>'Manage CourseMaterial','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Course Materials')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
