<?php
$this->breadcrumbs=array(
	'Attendance Release Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AttendanceReleaseSetting','url'=>array('index')),
	array('label'=>'Create AttendanceReleaseSetting','url'=>array('create')),
	array('label'=>'View AttendanceReleaseSetting','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AttendanceReleaseSetting','url'=>array('admin')),
);
?>

<h1>Update AttendanceReleaseSetting <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>