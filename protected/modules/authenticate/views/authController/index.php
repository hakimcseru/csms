<?php
$this->breadcrumbs=array(
	'Auth Controllers',
);

$this->menu=array(
array('label'=>'Create AuthController','url'=>array('create')),
array('label'=>'Manage AuthController','url'=>array('admin')),
);
?>

<h1>Auth Controllers</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
