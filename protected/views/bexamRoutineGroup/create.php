<?php
$this->breadcrumbs=array(
	'Bexam Routine Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BexamRoutineGroup','url'=>array('index')),
	array('label'=>'Manage BexamRoutineGroup','url'=>array('admin')),
);
?>

<h1>Create BexamRoutineGroup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>