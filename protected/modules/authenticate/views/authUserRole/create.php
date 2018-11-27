<?php
$this->breadcrumbs=array(
	'Auth User Roles'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List AuthUserRole','url'=>array('index')),
array('label'=>'Manage AuthUserRole','url'=>array('admin')),
);
?>

<h1>Create AuthUserRole</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>