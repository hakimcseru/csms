<?php
$this->breadcrumbs=array(
	'Class Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClassModel','url'=>array('index')),
	array('label'=>'Manage ClassModel','url'=>array('admin')),
);
?>

<h1>Create ClassModel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>