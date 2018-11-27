<?php
$this->breadcrumbs=array(
	'Examsettings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Examsetting','url'=>array('index')),
	array('label'=>'Manage Examsetting','url'=>array('admin')),
);
?>

<h1>Create Examsetting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>