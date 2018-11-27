<?php
$this->breadcrumbs=array(
	'Attendance Temp Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AttendanceTempData','url'=>array('index')),
	array('label'=>'Create AttendanceTempData','url'=>array('create')),
	array('label'=>'View AttendanceTempData','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AttendanceTempData','url'=>array('admin')),
);
?>

<h1>Update AttendanceTempData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>