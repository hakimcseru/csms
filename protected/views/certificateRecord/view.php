<?php
$this->breadcrumbs=array(
	'Certificate Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CertificateRecord','url'=>array('index')),
	array('label'=>'Create CertificateRecord','url'=>array('create')),
	array('label'=>'Update CertificateRecord','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CertificateRecord','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CertificateRecord','url'=>array('admin')),
);
?>

<h1>View Certificate Record #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'received_date',
		'received_by',
		'student_id',
		'course_id',
		'department_id',
		'session_id',
		'batch_id',
		'batch_group_id',
	),
)); ?>
