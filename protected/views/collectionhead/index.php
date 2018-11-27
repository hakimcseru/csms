<?php
$this->breadcrumbs=array(
	'Collection Heads',
);

$this->menu=array(
	array('label'=>'Create CollectionHead','url'=>array('create')),
	array('label'=>'Manage CollectionHead','url'=>array('admin')),
);
?>

<h1>Collection Heads</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
