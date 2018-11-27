<?php
$this->breadcrumbs=array(
	'Attendance Leaves'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AttendanceLeave','url'=>array('index')),
	array('label'=>'Create AttendanceLeave','url'=>array('create')),
	array('label'=>'Update AttendanceLeave','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AttendanceLeave','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AttendanceLeave','url'=>array('admin')),
);
?>

<h1>View AttendanceLeave #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'core_employee_id'=>array(
			'name'=>'core_employee_id',
			'type'=>'raw',
			'value'=> "<div style='text-align:left;'>
				<img src='".$model->employee->getImage(48,48)."' />".
				$model->employee->name." (".Bndate::t($model->core_employee_id).")</div>",
			),
		'start_date'=>array('name'=>'start_date', 'value'=>Bndate::t($model->start_date, true)),
		'end_date'=>array('name'=>'end_date', 'value'=>Bndate::t($model->end_date, true)),
		'duration'=>array('name'=>'duration', 'value'=>Bndate::t($model->duration)),
		'type'=>array('name'=>'type', 'value'=>$model->types[$model->type]),
		'description',
		'responsible_person_id'=>array('name'=>'responsible_person_id', 'value'=> isset($model->responsiblePerson)? $model->responsiblePerson->name.' ('.Bndate::t($model->responsible_person_id).')' : null),
		'approved_by_id'=>array('name'=>'approved_by_id', 'value'=> isset($model->approvedBy)? $model->approvedBy->name.' ('.Bndate::t($model->approved_by_id).')' : null),
		'note',
	),
)); ?>
