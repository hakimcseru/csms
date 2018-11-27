<?php
$this->breadcrumbs=array(
	'Calendar Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CalendarInfo','url'=>array('index')),
	array('label'=>'Manage CalendarInfo','url'=>array('admin')),
);
?>

<h1>Create CalendarInfo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>