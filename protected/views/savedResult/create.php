<?php
$this->breadcrumbs=array(
	'Saved Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SavedResult','url'=>array('index')),
	array('label'=>'Manage SavedResult','url'=>array('admin')),
);
?>

<h1>Create SavedResult</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>