<?php
$this->breadcrumbs=array(
	'Class Periods'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClassPeriod','url'=>array('index')),
	array('label'=>'Manage ClassPeriod','url'=>array('admin')),
);
?>

<h1>Create ClassPeriod</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>