<?php
$this->breadcrumbs=array(
	'Attendance Temp Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AttendanceTempData','url'=>array('index')),
	array('label'=>'Create AttendanceTempData','url'=>array('create')),
	array('label'=>'Update AttendanceTempData','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete AttendanceTempData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AttendanceTempData','url'=>array('admin')),
);
?>

<h2><?php echo Yii::t('attendance', 'Temporary Attendance: {n}', array('{n}'=>Bndate::t($model->id))); ?></h2>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		array('name'=>'core_employee_id', 'value'=>$model->tCore_employee_id()),
		array('name'=>'date', 'value'=>$model->tDate()),
		array('name'=>'time', 'value'=>$model->tTime()),
		array('name'=>'mode', 'value'=>$model->tMode()),
		'note',
	),
)); ?>
