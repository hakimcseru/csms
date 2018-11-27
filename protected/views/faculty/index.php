<?php
$this->breadcrumbs=array(
	Yii::t('core','Faculty'),
);

$this->menu=array(
	array('label'=>'Create Faculty','url'=>array('create')),
	array('label'=>'Manage Faculty','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Faculty') ?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
