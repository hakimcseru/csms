<?php
$this->breadcrumbs=array(
	'Bexam Routine Groups'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BexamRoutineGroup','url'=>array('index')),
	array('label'=>'Create BexamRoutineGroup','url'=>array('create')),
	array('label'=>'View BexamRoutineGroup','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BexamRoutineGroup','url'=>array('admin')),
);
?>

<h1>Update BexamRoutineGroup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>