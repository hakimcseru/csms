<?php
$this->breadcrumbs=array(
	'Auth Actions'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AuthAction','url'=>array('index')),
array('label'=>'Manage AuthAction','url'=>array('admin')),
);
?>

<h1>Create AuthAction</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>