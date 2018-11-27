<?php
$this->breadcrumbs=array(
	'Saved Result Subjects',
);

$this->menu=array(
	array('label'=>'Create SavedResultSubject','url'=>array('create')),
	array('label'=>'Manage SavedResultSubject','url'=>array('admin')),
);
?>

<h1>Saved Result Subjects</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
