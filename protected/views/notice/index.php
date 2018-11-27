<?php
$this->breadcrumbs=array(
	Yii::t('core','NOTICE'),
);

$this->menu=array(
	array('label'=>'Create Notice','url'=>array('create')),
	array('label'=>'Manage Notice','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','NOTICE')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
