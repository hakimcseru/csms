<?php
$this->breadcrumbs=array(
	'Examsettings',
);

$this->menu=array(
	array('label'=>'Create Examsetting','url'=>array('create')),
	array('label'=>'Manage Examsetting','url'=>array('admin')),
);
?>

<h1>Examsettings</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
