<?php
$this->breadcrumbs=array(
	'Result Setings',
);

$this->menu=array(
	array('label'=>'Create ResultSetings','url'=>array('create')),
	array('label'=>'Manage ResultSetings','url'=>array('admin')),
);
?>

<h1>Result Setings</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
