<?php
$this->breadcrumbs=array(
	Yii::t('core','Course'),
);

$this->menu=array(
	array('label'=>'Create Course','url'=>array('create')),
	array('label'=>'Manage Course','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Course')?></h1>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
