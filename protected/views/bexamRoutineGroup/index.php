<?php
$this->breadcrumbs=array(
	'Bexam Routine Groups',
);

$this->menu=array(
	array('label'=>'Create BexamRoutineGroup','url'=>array('create')),
	array('label'=>'Manage BexamRoutineGroup','url'=>array('admin')),
);
?>

<h1>Bexam Routine Groups</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
