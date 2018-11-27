<?php
$this->breadcrumbs=array(
	'Pis',
);

$this->menu=array(
	array('label'=>'Create Pi','url'=>array('create')),
	array('label'=>'Manage Pi','url'=>array('admin')),
);
?>

<h1>Pis</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
