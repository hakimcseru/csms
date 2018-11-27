<?php
$this->breadcrumbs=array(
	'Student Results',
);

$this->menu=array(
	array('label'=>'Create StudentResult','url'=>array('create')),
	array('label'=>'Manage StudentResult','url'=>array('admin')),
);
?>

<h1>Student Results</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
