<?php
$this->breadcrumbs=array(
	Yii::t('core','Student'),
);

$this->menu=array(
	array('label'=>'Create Student','url'=>array('create')),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
