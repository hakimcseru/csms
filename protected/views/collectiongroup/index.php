<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Groups'),
);

$this->menu=array(
	array('label'=>'Create StudentCollectionGroup','url'=>array('create')),
	array('label'=>'Manage StudentCollectionGroup','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student Collection Groups')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
