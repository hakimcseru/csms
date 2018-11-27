<?php
$this->breadcrumbs=array(
	'Faculty Member Attendance Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List FacultyMemberAttendanceData','url'=>array('index')),
	array('label'=>'Manage FacultyMemberAttendanceData','url'=>array('admin')),
);
?>

<h1>Create FacultyMemberAttendanceData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>