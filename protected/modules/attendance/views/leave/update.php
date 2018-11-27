<?php
$this->breadcrumbs=array(
	'Attendance Leaves'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AttendanceLeave','url'=>array('index')),
	array('label'=>'Create AttendanceLeave','url'=>array('create')),
	array('label'=>'View AttendanceLeave','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AttendanceLeave','url'=>array('admin')),
);
?>

<h1>Update AttendanceLeave <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>