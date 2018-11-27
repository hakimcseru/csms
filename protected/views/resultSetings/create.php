<?php
$this->breadcrumbs=array(
	'Result Setings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ResultSetings','url'=>array('index')),
	array('label'=>'Manage ResultSetings','url'=>array('admin')),
);
?>

<h1>Create ResultSetings</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>