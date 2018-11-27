<?php
$this->breadcrumbs=array(
	'Student Remainings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentRemaining','url'=>array('index')),
	array('label'=>'Manage StudentRemaining','url'=>array('admin')),
);
?>

<h1>Create StudentRemaining</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>