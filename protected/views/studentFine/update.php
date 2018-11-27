<?php
$this->breadcrumbs=array(
	'Student Fines'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentFine','url'=>array('index')),
	array('label'=>'Create StudentFine','url'=>array('create')),
	array('label'=>'View StudentFine','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StudentFine','url'=>array('admin')),
);
?>

<h1>Update StudentFine <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>