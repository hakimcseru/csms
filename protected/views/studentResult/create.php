<?php
$this->breadcrumbs=array(
	'Student Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentResult','url'=>array('index')),
	array('label'=>'Manage StudentResult','url'=>array('admin')),
);
?>

<h1>Create StudentResult</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>