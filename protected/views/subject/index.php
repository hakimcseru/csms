<?php
$this->breadcrumbs=array(
	'Subjects',
);

$this->menu=array(
	array('label'=>'Create Subject','url'=>array('create')),
	array('label'=>'Manage Subject','url'=>array('admin')),
);
?>

<h1>Subjects</h1>

<?php $this->widget('ext.bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
