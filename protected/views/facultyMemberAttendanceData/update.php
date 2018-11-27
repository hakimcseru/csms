<?php
$this->breadcrumbs=array(
	'Faculty Member Attendance Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FacultyMemberAttendanceData','url'=>array('index')),
	array('label'=>'Create FacultyMemberAttendanceData','url'=>array('create')),
	array('label'=>'View FacultyMemberAttendanceData','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FacultyMemberAttendanceData','url'=>array('admin')),
);
?>

<h1>Update FacultyMemberAttendanceData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>