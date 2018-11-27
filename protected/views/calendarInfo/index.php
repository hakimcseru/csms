<?php
$this->breadcrumbs=array(
	'Calendar Infos',
);

$this->menu=array(
	array('label'=>'Create CalendarInfo','url'=>array('create')),
	array('label'=>'Manage CalendarInfo','url'=>array('admin')),
);
?>

<h1>Calendar Infos</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
