<?php
$this->breadcrumbs=array(
	'Student Fines',
);

$this->menu=array(
	array('label'=>'Create StudentFine','url'=>array('create')),
	array('label'=>'Manage StudentFine','url'=>array('admin')),
);
?>

<h1>Student Fines</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
