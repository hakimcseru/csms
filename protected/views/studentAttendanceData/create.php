<?php
$this->breadcrumbs=array(
	'Student Attendance Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentAttendanceData','url'=>array('index')),
	array('label'=>'Manage StudentAttendanceData','url'=>array('admin')),
);
?>

<h1>Create StudentAttendanceData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>