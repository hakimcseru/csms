<?php
$this->breadcrumbs=array(
	'Attendance Temp Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AttendanceTempData','url'=>array('index')),
	array('label'=>'Manage AttendanceTempData','url'=>array('admin')),
);
?>

<h1>Create AttendanceTempData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>