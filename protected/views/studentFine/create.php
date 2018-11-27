<?php
$this->breadcrumbs=array(
	'Student Fines'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentFine','url'=>array('index')),
	array('label'=>'Manage StudentFine','url'=>array('admin')),
);
?>

<h1>Create StudentFine</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>