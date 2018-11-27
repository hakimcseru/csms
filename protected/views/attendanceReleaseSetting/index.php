<?php
$this->breadcrumbs=array(
	'Attendance Release Settings',
);

$this->menu=array(
	array('label'=>'Create AttendanceReleaseSetting','url'=>array('create')),
	array('label'=>'Manage AttendanceReleaseSetting','url'=>array('admin')),
);
?>

<h1>Attendance Release Settings</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
