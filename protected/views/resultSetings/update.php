<?php
$this->breadcrumbs=array(
	'Result Setings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ResultSetings','url'=>array('index')),
	array('label'=>'Create ResultSetings','url'=>array('create')),
	array('label'=>'View ResultSetings','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ResultSetings','url'=>array('admin')),
);
?>

<h1>Update ResultSetings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>