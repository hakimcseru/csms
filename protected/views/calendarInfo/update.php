<?php
$this->breadcrumbs=array(
	'Calendar Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CalendarInfo','url'=>array('index')),
	array('label'=>'Create CalendarInfo','url'=>array('create')),
	array('label'=>'View CalendarInfo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CalendarInfo','url'=>array('admin')),
);
?>

<h1>Update CalendarInfo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>