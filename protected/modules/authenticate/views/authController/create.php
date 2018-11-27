<?php
$this->breadcrumbs=array(
	'Auth Controllers'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AuthController','url'=>array('index')),
array('label'=>'Manage AuthController','url'=>array('admin')),
);
?>

<h1>Create AuthController</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>