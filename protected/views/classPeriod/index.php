<?php
$this->breadcrumbs=array(
	'Class Periods',
);

$this->menu=array(
	array('label'=>'Create ClassPeriod','url'=>array('create')),
	array('label'=>'Manage ClassPeriod','url'=>array('admin')),
);
?>

<h1>Class Periods</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
