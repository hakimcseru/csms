<?php
$this->breadcrumbs=array(
	'Attendance Final Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AttendanceFinalData','url'=>array('index')),
	array('label'=>'Create AttendanceFinalData','url'=>array('create')),
	array('label'=>'View AttendanceFinalData','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AttendanceFinalData','url'=>array('admin')),
);
?>

<h1>Update AttendanceFinalData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>