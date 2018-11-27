<?php
$this->breadcrumbs=array(
	'Student Enrollment Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentEnrollmentInfo','url'=>array('index')),
	array('label'=>'Manage StudentEnrollmentInfo','url'=>array('admin')),
);
?>

<h1>Create StudentEnrollmentInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>