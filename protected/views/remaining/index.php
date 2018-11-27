<?php
$this->breadcrumbs=array(
	Yii::t('core','Student Remaining'),
);

$this->menu=array(
	array('label'=>'Create StudentRemaining','url'=>array('create')),
	array('label'=>'Manage StudentRemaining','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','Student Remaining')?></h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
