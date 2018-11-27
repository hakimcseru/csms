<?php
$this->breadcrumbs=array(
	Yii::t('core','Section'),
);

$this->menu=array(
	array('label'=>'Create BatchSection','url'=>array('create')),
	array('label'=>'Manage BatchSection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Section')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
