<?php
$this->breadcrumbs=array(
	'Attendance Leaves'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AttendanceLeave','url'=>array('index')),
	array('label'=>'Manage AttendanceLeave','url'=>array('admin')),
);
?>

<h1>Create AttendanceLeave</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>