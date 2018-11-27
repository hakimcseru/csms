<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Collections'),
);

$this->menu=array(
	array('label'=>'Create StudentCollection','url'=>array('create')),
	array('label'=>'Manage StudentCollection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student Collections')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
