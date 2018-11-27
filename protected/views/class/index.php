<?php
$this->breadcrumbs=array(
	'Class Models',
);

$this->menu=array(
	array('label'=>'Create ClassModel','url'=>array('create')),
	array('label'=>'Manage ClassModel','url'=>array('admin')),
);
?>

<h1>Class Models</h1>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
