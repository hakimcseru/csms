<?php
$this->breadcrumbs=array(
	Yii::t('core','Department'),
);

$this->menu=array(
	array('label'=>'Create Department','url'=>array('create')),
	array('label'=>'Manage Department','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Department')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
