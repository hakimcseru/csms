<?php
$this->breadcrumbs=array(
	'Account Processes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AccountProcess','url'=>array('index')),
	array('label'=>'Manage AccountProcess','url'=>array('admin')),
);
?>

<h1>Create AccountProcess</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>