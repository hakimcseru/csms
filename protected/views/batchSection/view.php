<?php
$this->breadcrumbs=array(
	Yii::t('core','Section')=>array('index'),
	Bndate::t($model->id),
);

$this->menu=array(
	array('label'=>'List BatchSection','url'=>array('index')),
	array('label'=>'Create BatchSection','url'=>array('create')),
	array('label'=>'Update BatchSection','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete BatchSection','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BatchSection','url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('core','View Section')?> #<?php echo Bndate::t($model->id) ?></h1>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		//'batch_group_id',
		'batch_group_id'=>array('name'=>'batch_group_id','value'=>Bndate::t($model->batchgroup->group_name)),
		'section_name',
		'start_role',
		'end_role',
		'session_id',
		//'course_id',
		array('name'=>'course_id','value'=>$model->course_id?$model->course->course_name:null),
		//'department_id',
		'department_id'=>array('name'=>'department_id','value'=>Bndate::t($model->department->department_name)),
		//'batch_id',
		'batch_id'=>array('name'=>'batch_id','value'=>Bndate::t($model->batch->batch_id)),
	),
)); ?>
