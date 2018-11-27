<?php
$this->breadcrumbs=array(
	'Attendance Final Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AttendanceFinalData','url'=>array('index')),
	array('label'=>'Manage AttendanceFinalData','url'=>array('admin')),
);
?>

<h1>Create AttendanceFinalData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>