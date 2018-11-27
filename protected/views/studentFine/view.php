<?php
$this->breadcrumbs=array(
	'Student Fines'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StudentFine','url'=>array('index')),
	array('label'=>'Create StudentFine','url'=>array('create')),
	array('label'=>'Update StudentFine','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete StudentFine','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentFine','url'=>array('admin')),
);
?>

<h1>View StudentFine #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'student_pk',
		'student_id',
		'amount',
		'session_id',
		'fine_date',
		'year',
		'month',
		'comment',
	),
)); ?>
