<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collection Details'),
);

$this->menu=array(
	array('label'=>'Create StudentCollectionDetail','url'=>array('create')),
	array('label'=>'Manage StudentCollectionDetail','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student Collection Details')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
