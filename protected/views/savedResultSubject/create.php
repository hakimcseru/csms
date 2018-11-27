<?php
$this->breadcrumbs=array(
	'Saved Result Subjects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SavedResultSubject','url'=>array('index')),
	array('label'=>'Manage SavedResultSubject','url'=>array('admin')),
);
?>

<h1>Create SavedResultSubject</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>