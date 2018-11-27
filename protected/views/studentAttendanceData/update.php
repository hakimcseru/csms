<?php
$this->breadcrumbs=array(
	'Student Attendance Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentAttendanceData','url'=>array('index')),
	array('label'=>'Create StudentAttendanceData','url'=>array('create')),
	array('label'=>'View StudentAttendanceData','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentAttendanceData','url'=>array('admin')),
);
?>

<h1>Update StudentAttendanceData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>