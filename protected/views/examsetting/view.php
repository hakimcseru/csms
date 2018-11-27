<?php
$this->breadcrumbs=array(
	'Examsettings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Examsetting','url'=>array('index')),
	array('label'=>'Create Examsetting','url'=>array('create')),
	array('label'=>'Update Examsetting','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Examsetting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Examsetting','url'=>array('admin')),
);
?>

<h1>View Examsetting #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session',
		//'course',
		array('name'=>'course','value'=>$model->course?$model->coursec->course_name:null),
		//'department',
		'department_id'=>array('name'=>'department_id','value'=>Bndate::t($model->departments->department_name)),
		//'subject',
		'subject'=>array('name'=>'subject','value'=>Bndate::t($model->subjects->subject_name)),
		'mark_type',
		//'teacher',
		'teacher'=>array('name'=>'teacher','value'=>$model->allteacher($model)),
		

	),
)); ?>
