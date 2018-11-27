<?php
$this->breadcrumbs=array(
	'Exam Results',
);

$this->menu=array(
	array('label'=>'Create ExamResult','url'=>array('create')),
	array('label'=>'Manage ExamResult','url'=>array('admin')),
);
?>

<h1>Exam Results</h1>

<?php $this->widget('bootstrap.widgets.BootListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
