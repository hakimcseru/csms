<?php
$this->breadcrumbs=array(
	'Auth Modules'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AuthModule','url'=>array('index')),
array('label'=>'Manage AuthModule','url'=>array('admin')),
);
?>

<h1>Create AuthModule</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>