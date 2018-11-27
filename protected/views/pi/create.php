<?php
$this->breadcrumbs=array(
	'Pis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pi','url'=>array('index')),
	array('label'=>'Manage Pi','url'=>array('admin')),
);
?>

<h1>Create Pi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>