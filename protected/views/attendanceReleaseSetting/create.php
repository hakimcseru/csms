<?php
$this->breadcrumbs=array(
	'Attendance Release Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AttendanceReleaseSetting','url'=>array('index')),
	array('label'=>'Manage AttendanceReleaseSetting','url'=>array('admin')),
);
?>

<h1>Create AttendanceReleaseSetting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>