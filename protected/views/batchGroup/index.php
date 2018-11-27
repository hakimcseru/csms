<?php
$this->breadcrumbs=array(
	'Batch Groups',
);

$this->menu=array(
	array('label'=>'Create BatchGroup','url'=>array('create')),
	array('label'=>'Manage BatchGroup','url'=>array('admin')),
);
?>

<h1>Batch Groups</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
