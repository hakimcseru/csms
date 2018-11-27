<?php
$this->breadcrumbs=array(
	'Saved Results',
);

$this->menu=array(
	array('label'=>'Create SavedResult','url'=>array('create')),
	array('label'=>'Manage SavedResult','url'=>array('admin')),
);
?>

<h1>Saved Results</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
