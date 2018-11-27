<?php
$this->breadcrumbs=array(
	'Students'=>array('index'),
	$model->student_pk,
);

$this->menu=array(
	array('label'=>'List Student','url'=>array('index')),
	array('label'=>'Create Student','url'=>array('create')),
	array('label'=>'Update Student','url'=>array('update','id'=>$model->student_pk)),
	array('label'=>'Delete Student','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->student_pk),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Student','url'=>array('admin')),
);
?>

<h1>View Student #<?php echo $model->student_pk; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'student_id',
		'student_name',
		'student_father_name',
		'student_mother_name',
		'student_present_address',
		'student_permanent_address',
		'student_nationality',
		'student_gender',
		'student_dob',
		'student_pob',
		'student_profession',
		'student_email',
		'student_fb_id',
		'student_contact',
		'student_blood_group',
		'student_qualification',
		'student_alternate_contact',
		'student_reason_of_photography',
		'student_expectation',
		'student_pk',
		'student_ref_batch_pk',
		'occupation',
		'student_image',
	),
)); ?>
